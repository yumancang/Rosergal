<?php
/**
 * Model
 *
 * DB模型
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */
 
namespace Twinkle\Model\Mysql;
 
use Twinkle\Base\Mysql as Mysql;
use Twinkle\Library\Framework\Container;


class PcodeModel extends Mysql 
{
    public $tableName = 'eload_promotion_code';
    
    public function __construct(Container $app = null)
    {
        parent::__construct($app);
    }
    
    public function updatePcodeTimesByCode($code)
    {
        
        $sql = "update " . PCODE . " SET cishu = cishu + 1 where code = ?";
        $object = $this->masterDb->executeQuery($sql, [$code]);
        
        return $object->rowCount();
    }
    
    public function addUserCouponByCandles($data)
    {
        $this->masterDb->insert($this->tableName, $data);
    }
    

}