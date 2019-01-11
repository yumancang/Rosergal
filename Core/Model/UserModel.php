<?php
/**
 * Model
 *
 * DB模型
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */
 
namespace App\Library\Model\Mysql;
 
use App\Library\Base\MysqlBase as MysqlBase;
use App\Library\Framework\Container;

class UserModel extends MysqlBase 
{
    
    public $tableName = 'eload_users';
    
    public function __construct(Container $app = null)
    {
       
        parent::__construct($app);
    }
    
    public function getUserPointNumByUserId($userId)
    {
        $sql = "SELECT avaid_point FROM ".$this->tableName." WHERE user_id = ".intval($userId);
    
        $count = $this->slaveDb->executeQuery($sql)
        ->fetchInto();
       
        return isset($count['avaid_point']) ? $count['avaid_point'] : 0;
    }
    
    public function reduceUser20Point($userId)
    {
        $sql = "UPDATE ".$this->tableName." SET avaid_point = avaid_point - 20 WHERE user_id = ? ";
        $object = $this->masterDb->executeQuery($sql, [intval($userId)]);
        
        return $object->rowCount();
    }
    
    public function addUserPointByCandles($userId,$point)
    {
        $sql = "UPDATE ".$this->tableName." SET avaid_point = avaid_point + ".$point." WHERE user_id = ? ";
        $object = $this->masterDb->executeQuery($sql, [intval($userId)]);
        
        return $object->rowCount();
    }

}