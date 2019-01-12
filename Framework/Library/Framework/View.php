<?php
/**
 * 视图
 * @author yumancang <laifaluo@126.com>
 *
 * */
namespace Twinkle\Framework;

class View
{
    
    private static $_instance = null;

    
    private function __construct() 
    {
    }
    
    public static function getInstance() 
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function handler()
    {
       
    }

}

