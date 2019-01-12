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


class OrderModel extends Mysql 
{
    
    public function __construct(Container $app = null)
    {
        parent::__construct($app);
    }
    
    public function getNopayedOrderByTimeAndPayid($time,$payId)
    {
        
        $orderData = $this->slaveDb->execQuery(
            $this->select('order_sn')
            ->from(ORDERINFO)
            ->where("order_status = ? AND add_time < ? ", [0,$time])
            ->whereIn('pay_id', $payId)
        )->fetchAll(self::FETCH_ASSOC);
        
        return $orderData;
    }
    
    public function getPointCodeInfoByorderSn($_ORN)
    {
        $pointArr = $this->slaveDb->execQuery(
            $this->select('used_point,user_id,promotion_code')
            ->from(ORDERINFO)
            ->where("order_sn = ? ", [$_ORN])
        )->fetch(self::FETCH_ASSOC);

        return $pointArr;
    }


    public function updateOrderStatusBySn($order_status,$order_sn)
    {
        $reutrn = $this->masterDb->update(ORDERINFO, ['order_status' => 11], "order_sn = '$order_sn'");

        return $reutrn->rowCount();

    }
    
    public function obtainAnniversaryOrderInfo($startTime,$endTime,$limit = 'LIMIT 0,100')
    {
        $sql = "SELECT a.user_id,b.email,sum(order_amount) as total_amount FROM eload_order_info as a
        LEFT JOIN eload_users as b ON b.user_id = a.user_id 
        WHERE order_status in (1,2,3,4,8,15,16,20) AND add_time < $endTime AND add_time > $startTime 
        GROUP BY user_id ORDER BY total_amount DESC $limit";
        $orderData = $this->slaveDb->execQueryString($sql)->fetchAll(self::FETCH_ASSOC);
        return $orderData;
    }
    
    public function obtainTodayOrderAmount($startTime,$endTime,$userId)
    {
        $sql = "SELECT sum(order_amount) as total_order_amount FROM eload_order_info
        WHERE order_status in (1,2,3,4,8,15,16,20) AND add_time < $endTime AND add_time > $startTime
        AND user_id = $userId";
       
        $orderData = $this->slaveDb->execQueryString($sql)->fetch(self::FETCH_ASSOC);
        return isset($orderData['total_order_amount']) ? $orderData['total_order_amount'] : 0;
    }
    
    public function obtainTodayAllUserOrderAmount($startTime,$endTime)
    {
        $sql = "SELECT sum(order_amount) as total_order_amount,user_id FROM eload_order_info
        WHERE order_status in (1,2,3,4,8,15,16,20) AND add_time < $endTime AND add_time > $startTime GROUP BY user_id";
         
        $orderData = $this->slaveDb->execQueryString($sql)->fetchAll(self::FETCH_ASSOC);
       
        return $orderData;
    }

}
