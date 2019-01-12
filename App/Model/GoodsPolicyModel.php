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
 
use Twinkle\Base\MysqlBase as MysqlBase;


class GoodsPolicyModel extends MysqlBase 
{
    
    public $tableName = 'public_v_dm_cloth_edm_market_goods';
    
    public $policyDb;
    
    public function __construct()
    {
        parent::__construct();
        //主库
        \Twinkle\Framework\Database\DB::setConfig(array(
            "dsn" => "mysql:host=".DB_HOST_POLICY.";port=".DB_POLICY_PORT.";dbname=".DB_NAME_POLICY,
            "username" => DB_USER_POLICY,
            "password" => DB_PWD_POLICY
        ),'policy');
        
        $this->policyDb = \Twinkle\Framework\Database\DB::getInstance("policy");
    }
    
    public function getGoodsByRules($catId,$hotNum,$latendNum)
    {
        $hotRow = [];
        $latendRow = [];
        //$catIds = explode(',', $catId);
        $sql = "select a.goods_id,a.sku from public_v_dm_cloth_edm_market_goods as a 
right join 
(select  SUBSTRING_INDEX(GROUP_CONCAT(
        goods_id
        ORDER BY quantity_7  DESC ),',',1) as goods_id,
max(quantity_7) as quantity_7_a from public_v_dm_cloth_edm_market_goods where goods_id > 0 AND cat_id IN ($catId)  group by sku_pre ORDER BY quantity_7_a DESC limit 0,$hotNum
) as b 
on a.goods_id=b.goods_id and a.quantity_7=b.quantity_7_a 
ORDER BY a.spu_quantity_7 DESC,a.spu_quantity_7_growth_rate DESC,a.hit_value_7 DESC ";
        $hotNum > 0 && $hotRow = $this->slaveDb->execQueryString(
            $sql
        )->fetchAll(self::FETCH_ASSOC);
        
        
        $sql = "select a.goods_id,a.sku from public_v_dm_cloth_edm_market_goods as a
        right join
        (select  SUBSTRING_INDEX(GROUP_CONCAT(
        goods_id
        ORDER BY quantity_7  DESC ),',',1) as goods_id,
        max(quantity_7) as quantity_7_a from public_v_dm_cloth_edm_market_goods where goods_id > 0 and spu_up_days <= 14 AND cat_id IN ($catId)  group by sku_pre ORDER BY quantity_7_a DESC limit 0,$latendNum
        ) as b
        on a.goods_id=b.goods_id and a.quantity_7=b.quantity_7_a
        ORDER BY a.trans_rate DESC,a.spu_quantity_all DESC,a.spu_quantity_7_growth_rate DESC,a.hit_value_14 DESC";
        $latendNum > 0 && $latendRow = $this->slaveDb->execQueryString(
            $sql
        )->fetchAll(self::FETCH_ASSOC);
        
        /* $latendNum > 0 && $latendRow = $this->slaveDb->execQuery(
            $this->select('goods_id,sku')
            ->from($this->tableName)
            ->where('spu_up_days <= ?',[14])
            ->where('goods_id > ?',[0])
            ->whereIn('cat_id',explode(',', $catId))
            ->groupBy("sku_pre")
            ->orderBy("trans_rate DESC,spu_quantity_all DESC,spu_quantity_7_growth_rate DESC,hit_value_14 DESC,quantity_all DESC")
            ->limit($latendNum,0)
        )->fetchAll(self::FETCH_ASSOC); */
        
        
        
        return array_merge($latendRow,$hotRow);
    }
    
    
    public function getGoodsInfoByWebsiteId($websiteId = 27)
    {
        $row = $this->policyDb->execQuery(
            $this->select('*')
            ->from($this->tableName )
            ->where('website_id = ?',[$websiteId])
        )->fetchAll(self::FETCH_ASSOC);
        
        return $row;
    }
    
    
    public function insertData($data)
    {
        $this->masterDb->insert($this->tableName, $data);
    }
    
    public function clearAllRosegalData()
    {
        $this->masterDb->delete($this->tableName, '', []);
    }

}
