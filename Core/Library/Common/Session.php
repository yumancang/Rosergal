<?php

/**
 * SESSION操作类
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

namespace App\Library\Common;



class Session 
{
    public function __construct()
    {
        
    }

    public function get($key, $defaultValue = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $defaultValue;
    }
    

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}


