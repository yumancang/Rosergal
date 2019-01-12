<?php
namespace Twinkle\Library\Common;

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

    private $requestIp;

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
     *
     * @param string $method
     * @param array $param
     * @return bool|null
     * @throws \Exception
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

    public function getRequestIp()
    {
        if ($this->requestIp != null) {
            return $this->requestIp;
        }

        $clientIp = '';
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_TRUE_CLIENT_IP'])) {
                $clientIp = $_SERVER['HTTP_TRUE_CLIENT_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                foreach ($arr AS $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $clientIp = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $clientIp = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $clientIp = $_SERVER['REMOTE_ADDR'];
                } else {
                    $clientIp = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_TRUE_CLIENT_IP')) {
                $clientIp = getenv('HTTP_TRUE_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
                $clientIp = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $clientIp = getenv('HTTP_CLIENT_IP');
            } else {
                $clientIp = getenv('REMOTE_ADDR');
            }
        }

        preg_match("/[\d\.]{7,15}/", $clientIp, $onlineIp);
        $clientIp = !empty($onlineIp[0]) ? $onlineIp[0] : '0.0.0.0';

        return $this->requestIp = $clientIp;
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


