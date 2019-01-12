<?php
/**
 * 入口初始化配置和常量
 * @author yumancang <laifaluo@126.com>
 *
 * */
namespace Twinkle\Framework;

use InvalidArgumentException;
use Autoloader;

class Framework
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
