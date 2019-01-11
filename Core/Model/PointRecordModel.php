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


class PointRecordModel extends MysqlBase 
{
    
    public function __construct(Container $app)
    {
        parent::__construct($app);
    }
    
    public function queryLikeSqlCount($_ORN)
    {
        $sql = "SELECT count(*) as count FROM eload_point_record WHERE note like  'Order:# {$_ORN} return%'";
        
        $count = $this->slaveDb->executeQuery($sql)
        ->fetchInto();
       
        return $count['count'];
    }
    
    

}