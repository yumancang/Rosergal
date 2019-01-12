<?php
/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

 
namespace Twinkle\Base;
use Twinkle\Library\Framework\Database\DB as DB;


class MysqlBase extends DB
{   
    public $masterDb;
    
    public $slaveDb;
    
    public function __construct()
    {
        //从库
        \Twinkle\Library\Framework\Database\DB::setConfig(array(
            "dsn" => "mysql:host=".DB_HOST_SLAVE_NEW.";port=".DB_HOST_SLAVE_PORT.";dbname=".DB_NAME_SLAVE,
            "username" => DB_USER_SLAVE,
            "password" => DB_PWD_SLAVE
        ),'slave');
        
        $this->slaveDb = \Twinkle\Library\Framework\Database\DB::getInstance("slave");
        
        //主库
        \Twinkle\Library\Framework\Database\DB::setConfig(array(
            "dsn" => "mysql:host=".DB_HOST_NEW.";port=".DB_HOST_PORT.";dbname=".DB_DATABASE,
            "username" => DB_USER,
            "password" => DB_PASSWORD
        ),'master');
        
        $this->masterDb = \Twinkle\Library\Framework\Database\DB::getInstance("master");
    }

    public function getInfoByCondition($condition, $field = '*', $orderBy = 'id desc')
    {
        if (empty($condition)) {
            return false;
        }

        $tempItem = [];
        $tempValue = [];
        foreach ($condition as $key => $value) {
            $tempItem[] = "{$key} = ?";
            $tempValue[] = $value;
        }

        return $this->slaveDb->execQuery(
            $this->select($field)
                ->from($this->tableName)
                ->where(implode(' AND ', $tempItem), $tempValue)
                ->orderBy($orderBy)
        )->fetchInto(self::FETCH_ASSOC);
    }

    public function insertData($data)
    {
        return $this->masterDb->insert($this->tableName, $data);
    }

}

/*
\Twinkle\Library\Framework\Database\DB::setConfig(array(
    "dsn" => "mysql:host=192.168.6.71;dbname=rosegal_db",
    "username" => "root",
    "password" => "NvGHHsQvo3!90YS@"
));

$db = \Twinkle\Library\Framework\Database\DB::getInstance("default");


$goods = new \Twinkle\Model\Mysql\Goods();
$count = $goods->getGoodsTotals();



//从库
\Twinkle\Library\Framework\Database\DB::setConfig(array(
    "dsn" => "mysql:host=192.168.6.71;dbname=rosegal_db",
    "username" => "root",
    "password" => "NvGHHsQvo3!90YS@"
),'slave');

$slaveDb = \Twinkle\Library\Framework\Database\DB::getInstance("slave");

//主库
\Twinkle\Library\Framework\Database\DB::setConfig(array(
    "dsn" => "mysql:host=192.168.6.71;dbname=rosegal_db",
    "username" => "root",
    "password" => "NvGHHsQvo3!90YS@"
),'master');

$masterDb = \Twinkle\Library\Framework\Database\DB::getInstance("master");



class Goods {
    public $goods_id;
}


class GoodsExtend
{

}


//查询总量,返回影响的行数
$count = $db->count("eload_users");
var_dump($count);
exit();

//删除语句,返回影响的行数
$sss = $db->delete("eload_users", "user_id = ?", 7155);
$sss=  $sss->rowCount();
var_dump($sss);
exit();

//更新语句,返回影响的行数
$data['firstname'] = 'firstname2';
$sss = $db->update("eload_users", $data, "user_id = ?", 7155);
//$data['firstname'] = 'firstname1';
//$sss = $db->update("eload_users", $data, "user_id = ? AND email = ?", array(7155, "user@example.com"));

$sss=  $sss->rowCount();
var_dump($sss);
exit();
//插入数据，返回插入的自增ID

$data = array(
    "email" => "user@example.com"
);
$db->insert("eload_users", $data);

$sss = $db->lastInsertId();

var_dump($sss);
exit();

//链接查询
$sql = $db->select("g.goods_id, eg.first_on_sale_time")
->from("eload_goods g")
->join("LEFT JOIN eload_goods_extend eg on eg.goods_id = g.goods_id")
->where("g.goods_id = ?", 36571)
->orderBy("g.goods_id");

$stmt = $sql->execute();


$post_collection = array();

// Fetching data into Post object from posts table (p is alias)
while($post = $stmt->fetchInto(new Goods)) {
    $post_collection[] = (array) $post;
}

prend($post_collection);



//单个查询

$sql = "SELECT * FROM eload_goods where goods_id = ? and is_on_sale = ? limit 1";
$goods = $db->executeQuery($sql,[36571,0])
->fetchInto(new Goods); // or ->fetchObject("User") as in standard PDO driver


prend($goods);
*/