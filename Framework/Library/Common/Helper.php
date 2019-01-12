<?php

/**
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */

namespace Twinkle\Common;

class Helper
{
    public static function getUserCountry($countryList, $userCountry)
    {
        $customer_country_code = isset($countryList[strtoupper($userCountry)]) ? $countryList[strtoupper($userCountry)]['region_id'] : 0;
        return $customer_country_code;
    }

    public static function getBfCondition($table = 'ge')
    {
        if (checkBFByCountry()) {
            return [1, " AND {$table}.is_bf = 0 "];
        }
        return [0, ''];
    }
}


