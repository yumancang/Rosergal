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
 
use Twinkle\Base\MysqlBase as MysqlBase;


class SpecialGoods extends MysqlBase 
{
    
    public $tableName = 'eload_special_goods';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function deleteByPositionId($positionId)
    {
        $this->masterDb->delete($this->tableName, 'position_id = '.$positionId,[]);
    }

    public function batchInsert($data)
    {
        $this->masterDb->batchInsert($this->tableName,$data);
    }
    
    
    public function getDefaultLangAnniversarSeckillGoods($specialId, $positionId, $startTime,$endTime)
    {
        $sql  = "SELECT g.goods_id,g.goods_sn, g.goods_title, g.url_title, g.shop_price, g.market_price, g.promote_price, g.promote_start_date,g.promote_end_date," .
            " g.goods_number,g.goods_img,goods_grid,g.original_img,g.cat_id " .
            " FROM " . SPECIAL_GOODS . ' AS s INNER JOIN ' . GOODS . ' AS g ON g.goods_id=s.goods_id ' .
            " WHERE g.is_on_sale=1 AND g.is_delete=0 AND g.goods_number>0 AND g.promote_start_date = '{$startTime}' AND g.promote_end_date = '{$endTime}'  " .
            " AND s.position_id='{$positionId}' AND s.special_id= '{$specialId}' order by s.sort_order LIMIT 0,50";
        $data = $this->slaveDb->execQueryString($sql)->fetchAll(self::FETCH_ASSOC);
        return $data;
    }
    
    public function getMultLangAnniversarSeckillGoods($specialId, $positionId, $startTime ,$endTime,$cur_lang)
    {
        $sql  = 'SELECT g.goods_id,g.goods_sn, g.goods_title, g.url_title, g.shop_price, g.market_price, g.promote_price, g.promote_start_date,g.promote_end_date,' .
                ' g.goods_number,g.goods_img,goods_grid,g.original_img,g.cat_id,' .
                ' gl.goods_title as goods_title_lang,gl.url_title as url_title_lang' .
                ' FROM ' . SPECIAL_GOODS . ' AS s INNER JOIN ' . GOODS .' AS g ON g.goods_id=s.goods_id LEFT JOIN '.GOODS.'_'.$cur_lang.' AS gl ON g.goods_id=gl.goods_id ' .
                " WHERE g.is_on_sale=1 AND g.is_delete=0 AND g.goods_number>0 AND g.promote_start_date = '{$startTime}' AND g.promote_end_date = '{$endTime}' " .
                " AND s.position_id='{$positionId}' AND s.special_id= '{$specialId}' order by s.sort_order LIMIT 0,50";
    
        $data = $this->slaveDb->execQueryString($sql)->fetchAll(self::FETCH_ASSOC);
    
        return $data;
    }

}