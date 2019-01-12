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


class CodRuleModel extends MysqlBase
{
    public function getDataByCountryId($countryId)
    {
        return $this->slaveDb->execQuery(
            $this->select('currency,fee,cod_integer,price_interval')
                ->from(COD_RULE)
                ->where("country = ? ", [$countryId])
        )->fetch(self::FETCH_ASSOC);
    }

}