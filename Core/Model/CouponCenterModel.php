<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/9/29
 * Time: 15:04
 */

namespace App\Library\Model\Mysql;


use App\Library\Base\MysqlBase;

class CouponCenterModel extends MysqlBase
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