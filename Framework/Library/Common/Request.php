<?php
namespace Twinkle\Common;

use ArrayAccess;
/**
 * request
 * @author yumancang
 *
 */
class Request implements ArrayAccess
{    
    /**
     * $_GET
     * @var unknown
     */
    private $get;
    /**
     * $_POST
     * @var unknown
     */
    private $post;
    /**
     * $_SERVER
     * @var unknown
     */
    private $server;
    /**
     * $_REQUEST
     * @var unknown
     */
    private $request;
    /**
     * $_SESSION
     * @var unknown
     */
    private $session;
    
    private $env;
    
    private static $_instance = null;
    
    
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * 初始化全局参数
     */
    private function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->request = $_REQUEST;
        $this->session = new Session();
        $this->env = $_ENV;
    }
    
    /**
     * 获取全局变量
     * @param unknown $method
     * @param unknown $param
     */
    public function __call($method, $param)
    {
        if (!property_exists($this, $method)) {
            throw new \Exception('global data error', 401);
        }
        #设置
        if (isset($param[1])) {
            $this->{$method}[$param[0]] = $param[1];
            return true;
        } else {
            #获取
            return isset($this->{$method}[$param[0]]) ? $this->{$method}[$param[0]] : null;
        }
        
    }
    
    public function offsetGet($offset)
    {
        
    }
    
    public function offsetSet($offset, $value)
    {
        
    }
    
    public function offsetExists($offset)
    {
    
    }
    
    public function offsetUnset($offset)
    {
    
    }
    
    
}


