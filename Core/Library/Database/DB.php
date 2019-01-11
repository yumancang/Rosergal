<?php
namespace App\Library\Framework\Database;

/**
 * DB - MySQL database library
 *
 * @author Sasa
 * 
 * @lastmodifed Python Luo <laifaluo@126.com>
 *
 */
class DB extends \PDO
{

    const INSERT = "INSERT INTO";
    const UPDATE = "UPDATE";
    const REPLACE = "REPLACE";

    // 增加重试机制
    protected $retryLimit = 3;
    protected $retryWait = 1000;

    private static $config = array();

    /**
     * @var DB[]
     */
    private static $instances = array();

    /**
     * @var \Closure
     */
    private static $exception_callback;

    /**
     * @param string $instance
     * @return DB
     * @throws \Exception
     */
    static function getInstance($instance = 'default')
    {
        if(!array_key_exists($instance, self::$instances)) {
            // check if configuration exists
            
            if(!array_key_exists($instance, self::$config)) {
                throw new \Exception("Configuration is not set. Use DB::setConfig(options, [instance]) to set");
            }

            self::$instances[$instance] = new self(
                self::$config[$instance]["dsn"],
                self::$config[$instance]["username"],
                self::$config[$instance]["password"],
                self::$config[$instance]["options"]
            );
        }

        return self::$instances[$instance];
    }

    /**
     * Set database config params
     * config param should contains dsn, username, password and options
     * 
     * @param array $config
     * @param string $instance
     */
    static function setConfig($config, $instance = 'default')
    {
        self::$config[$instance]['dsn'] = array_key_exists('dsn', $config) ? $config['dsn'] : "";
        self::$config[$instance]['username'] = array_key_exists('username', $config) ? $config['username'] : null;
        self::$config[$instance]['password'] = array_key_exists('password', $config) ? $config['password'] : null;
        self::$config[$instance]['options'] = array_key_exists('options', $config) ? $config['options'] : array();
    }

    /**
     * @throws \PDOException|\Exception
     * @param string $dsn
     * @param null $username
     * @param null $password
     * @param array $options
     */
    function __construct($dsn, $username = null, $password = null, $options = array())
    {
        // Default options
        $options = $options + array(
            \PDO::ATTR_STATEMENT_CLASS => array("App\\Library\\Framework\\Database\\Statement", array($this)),
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        );

        $retries = 0;

        CONNECTION_RETRY: {
            try {
                // We're using @ because PDO produces Warning before PDOException.
                parent::__construct($dsn, $username, $password, $options);
                //$this->setAttribute(\PDO::ATTR_STATEMENT_CLASS, array('DBStatement', array($this)));
            } catch (\Exception $e) {

                if ($retries == $this->retryLimit) {
                    if (null !== self::$exception_callback && is_callable(self::$exception_callback)) {
                        call_user_func_array(self::$exception_callback, array($e));
                    } else {
                        throw $e;
                    }
                }

                usleep($this->retryWait * 1000);

                ++$retries;
                goto CONNECTION_RETRY;
            }
        }
    }


    /**
     * Build and Get SET statement
     *
     * $this->getSetStmt(DB::INSERT, "mytable", array("name" => "John"));
     * will return:
     * INSERT INTO
     * @param string $syntax INSERT, UPDATE, REPLACE
     * @param string $table
     * @param array $data
     * @param null $where
     * @return \PDOStatement
     */
    private function getSetStmt($syntax, $table, $data, $where = null)
    {
        $columns = array();

        foreach (array_keys($data) as $column) {
            $columns[] = "`" . $column . "` = ?";
        }
        $columns = implode(", ", $columns);

        $sql = "$syntax `$table` SET " . $columns . $this->buildWhere($where);
        
        return $this->prepare($sql);
    }

    /**
     * Perform INSERT, UPDATE, REPLACE
     *
     * @param string $syntax
     * @param string $table
     * @param array $data
     * @param null $where
     * @param array $where_params
     * @return Statement|\PDOStatement
     */
    private function executeBySyntax($syntax, $table, $data, $where = null, $where_params = array())
    {
        if (!is_null($where) && !is_array($where)) {
            $where = array($where);
        }

        if (is_object($data)) {
            $data = (array) $data;
        }


        // support for scalar param
        if (!is_array($where_params)) {
            $where_params = array($where_params);
        }

        $stmt = $this->getSetStmt($syntax, $table, $data, $where);
        
        $stmt->execute(array_merge(array_values($data), $where_params));

        return $stmt;
    }
    /**
     * Insert one row
     *
     * @throw PDOException
     *
     * @param string $table
     * @param array $data
     * @return Statement
     */
    function insert($table, $data)
    {
        return $this->executeBySyntax(self::INSERT, $table, $data);
    }


    /**
     * Insert one row
     *
     * @throw PDOException
     *
     * @param string $table
     * @param array $data
     * @return Statement
     */
    function batchInsert($table, $data)
    {
        foreach ($data as $key => $val) {
            $this->executeBySyntax(self::INSERT, $table, $val);
        }

    }

    /**
     * Update row in table, optionally use previous prepared stmt by stmt_key
     *
     * @throw PDOException
     *
     * @param string $table
     * @param array $data
     * @param mixed $where
     * @param mixed|array $where_params
     * @return Statement
     */
    function update($table, $data, $where, $where_params = array())
    {
        return $this->executeBySyntax(self::UPDATE, $table, $data, $where, $where_params);
    }

    /**
     * Insert or replace row in a table
     *
     * @throw PDOException
     *
     * @param string $table
     * @param array $data
     * @return Statement
     */
    function replace($table, $data)
    {
        return $this->executeBySyntax(self::REPLACE, $table, $data);
    }

    /**
     * Delete rows from table
     *
     * @throw PDOException
     *
     * @param string $table
     * @param mixed $where
     * @param mixed $where_params
     * @return Statement
     */
    function delete($table, $where, $where_params)
    {
        $sql = "DELETE FROM " . $table . $this->buildWhere($where);
        $stmt = $this->executeQuery($sql, $where_params);

        return $stmt;
    }

    /**
     * Count rows in one table - very simple implementation
     *
     * @param string $table
     * @param mixed $where
     * @param array $where_params
     * @return int
     */
    function count($table, $where = null, $where_params = null)
    {
        $sql = "SELECT COUNT(*) FROM " . $table . $this->buildWhere($where);
        $stmt = $this->executeQuery($sql, $where_params);

        return $stmt->fetchColumn();
    }

    /**
     * @deprecated since version 1.0
     */
    function executeQuery($sql, $params = null)
    {
        return $this->execQueryString($sql, $params);
    }

    /**
     * Prepare & execute query with params
     *
     * @throw PDOException
     *
     * @param string $sql
     * @param array|null $params
     * @return Statement
     */
    function execQueryString($sql, $params = null)
    {
       
        if (!is_array($params) && !is_null($params)) {
            $params = array($params);
        }

        if(stripos($sql,'UPDATE')!==false || stripos($sql,'INSERT')!==false  )
        {
            $FileStr = '';
            $sqlSource = '';
            $BackTrace	= debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,5);
            if($BackTrace)
            {
                foreach($BackTrace AS $val)
                {
                    if(isset($val['file'],$val['line']))
                    {
                        $FileStr.=$val['file'].':'.$val['line'];
                    }
                }
            }

            !empty($_SERVER['REDIRECT_URL']) && $sqlSource .= 'REDIRECT_URL: ' . $_SERVER['REDIRECT_URL'];
            !empty($_SERVER['HTTP_REFERER']) && $sqlSource .= ';HTTP_REFERER: ' . $_SERVER['HTTP_REFERER'];
            !empty($_SERVER['QUERY_STRING']) && $sqlSource .= ';QUERY_STRING:' . $_SERVER['QUERY_STRING'];
            $sqlSource = str_replace(['*/','?'],[' ','#'],  $sqlSource . ';FILE: ' . $FileStr);
            $sql .= ' /* '.$sqlSource.' */';
        }

        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * @param Query $query
     * @return Statement
     */
    public function execQuery(Query $query)
    {
        return $this->execQueryString($query->getQuery(), $query->getParams());
    }

    /**
     * Build where statement for SQL query
     *
     * @param mixed $where
     * @param string $operand AND | OR
     * @return string
     */
    function buildWhere($where, $operand = "AND")
    {
        if (empty($where)) {
            return "";
        }

        if (is_array($where)) {
            $wheres = array();
            foreach ($where as $k => $w) {
                $wheres[] = "(" . $w . ")";
            }
            $where = implode(" $operand ", $wheres);
        }

        return " WHERE " . $where;
    }

    /**
     * Get Database Query Builder
     * @return Query
     */
    function createQuery()
    {
        return new Query($this);
    }

    /**
     * Shortcut for createQuery()->select
     *
     * @param string $statement
     * @return Query
     */
    function select($statement = "")
    {
        return $this->createQuery()->select($statement);
    }

    /**
     * Get all columns from table
     *
     * @throw PDOException
     *
     * @param $table
     * @return array
     */
    function getColumnsFromTable($table)
    {
        $sql = "DESCRIBE $table";

        return $this->executeQuery($sql)
            ->fetchAll(self::FETCH_COLUMN);
    }

    /**
     * Save data to table
     *
     * @throw PDOException
     *
     * @param string $table
     * @param array $data
     * @param string $primary_key Name of primary key column
     * @return Statement
     */
    function save($table, $data, $primary_key)
    {
        // Update if primary key exists in data set or insert new row
        if (!empty($data[$primary_key])) {
            return $this->update($table, $data, $primary_key . " = ?", $data[$primary_key]);
        } else {
            return $this->insert($table, $data);
        }
    }
    




}
