<?php

/**
 * Cookie操作类
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

namespace Twinkle\Library\Common;



class Cookie 
{
    
    public static function get($key, $defaultValue = null)
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : $defaultValue;
    }

}


