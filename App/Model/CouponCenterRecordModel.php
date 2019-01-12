<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/9/29
 * Time: 15:18
 */

namespace Twinkle\Model\Mysql;


use Twinkle\Base\Mysql;

class CouponCenterRecordModel extends Mysql
{

    public $tableName = COUPON_CENTER_RECORD;

    public function getInfoByCondition($condition, $field = '*')
    {
        if (empty($condition)) {
            return false;
        }

        $tempItem = [];
        $tempValue = [];
        foreach ($condition as $key => $value) {
            $tempItem[] = "{$key} = ?";
            $tempValue[] = $value;
        }

        return $this->slaveDb->execQuery(
            $this->select($field)
                ->from(COUPON_CENTER_RECORD)
                ->where(implode(' AND ', $tempItem), $tempValue)
        )->fetchInto(self::FETCH_ASSOC);
    }

}