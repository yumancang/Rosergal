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


class GoodsModel extends MysqlBase 
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getGoodsTotals()
    {
        //查询总量,返回影响的行数
        $count = $this->slaveDb->count("eload_users");
        return $count;
    }
    
    public function getGoodsIdByGoodsSn($goodsSnArr)
    {
        $payed_where = db_create_in($goodsSnArr, 'goods_sn');
        
        $data = $this->slaveDb->execQueryString('SELECT goods_id FROM eload_goods where '.$payed_where)
            ->fetchAll(self::FETCH_ASSOC);
        return array_column($data, 'goods_id');
       
    }
    
    
    public function getCatIdByGoodsSn($goodsSn)
    {
        $info = $this->slaveDb->execQuery(
            $this->select('cat_id,goods_id')
            ->from(GOODS)
            ->where("goods_sn = ? ", [$goodsSn])
        )->fetch(self::FETCH_ASSOC);
        
        return $info;
    }

}