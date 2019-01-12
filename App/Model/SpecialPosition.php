<?php
/**
 * Model
 *
 * 模型
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */
 
namespace Twinkle\Model\Mysql;
 
use Twinkle\Base\Mysql as Mysql;


class SpecialPosition extends Mysql 
{
    public $tableName = 'eload_special_position';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getGrapRulesPosition()
    {
        $orderData = $this->slaveDb->execQuery(
            $this->select('special_id,position_id,retrieveRule')
            ->from($this->tableName)
            ->where("retrieveRule <> '' and 1 ")
        )->fetchAll(self::FETCH_ASSOC);
        return $orderData;
    }
    
    
    /**
     * 通过专题ID获取置顶的版块ID
     * 
     * */
    public function getOneTopPlatePositionIdBySpecialId($specialId)
    {
        $sql = "SELECT position_id FROM ".SPECIAL_POSITION." WHERE special_id = '{$specialId}' AND is_top_plate = 1 LIMIT 1";
        $data = $this->slaveDb->execQueryString($sql)->fetchInto();

        return isset($data['position_id']) ? intval($data['position_id']) : false;
    }

}