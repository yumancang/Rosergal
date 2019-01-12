<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/9/29
 * Time: 15:04
 */

namespace Twinkle\Model\Mysql;


use Twinkle\Base\Mysql;

class CouponCenterModel extends Mysql
{

    public $tableName = COUPON_CENTER;

    public function getInfoById($couponId)
    {
        return $this->slaveDb->execQuery(
            $this->select('*')
                ->from(COUPON_CENTER)
                ->where("id = ?", [$couponId])
        )->fetchInto(self::FETCH_ASSOC);
    }

    public function increaseCouponCount($couponId)
    {
        $sql = "UPDATE " . COUPON_CENTER . " SET coupon_amount = coupon_amount + 1 WHERE id = ?";
        $object = $this->masterDb->execQueryString($sql, [$couponId]);
        return $object->rowCount();
    }
}