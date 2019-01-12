<?php
/**
 * 路由解析
 * @author yumancang <laifaluo@126.com>
 *
 * */
namespace Twinkle\Framework;

use Twinkle\Common\Request;
use Twinkle\Plugin\RouterPlugin;

class Router
{
    
    public $module = 'index';
    
    public $action = 'index';
    
    public $request;
    
    private static $_instance = null;

    
    private function __construct() 
    {
        $this->request = Request::getInstance();
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
        $strategy = 'GeneralStrategy';
        list($module, $action, $params) = (new \Twinkle\Router\GeneralStrategy())->parseUrl();
 
        $this->module = $module !== false ? $module : $this->module;
        $this->action = $action !== false ? $action : $this->action;
        foreach ($params as $paramName => $paramValue) {
            $this->request->get($paramName,$paramValue);
        }
    }

}

