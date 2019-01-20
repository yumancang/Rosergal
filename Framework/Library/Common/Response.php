<?php
namespace Twinkle\Library\Common;

/**
 * Response
 * @author yumancang
 *
 */
class Response
{    
    const HTTP_OK = 200;
    
    const HTTP_SERVER_ACTION_ERROR = 501;
    
    const HTTP_SERVER_CLASS_ERROR = 502;
    
    const HTTP_SERVER_NOLOGIN_ERROR = 503;
    
    const HTTP_SERVER_SAMEIP_ERROR = 504;
    
    const HTTP_SERVER_SAMEUSER_ERROR = 505;
    
    const HTTP_SERVER_CREATECOUPON_ERROR = 506;
    
    const HTTP_CLIENT_PARAM_ERROR = 401;

    protected $statusCode;
    
    protected $content;
    
    private static $_instance = null;
    
    
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        
    }
    
    public function setStatusCode($code = 200)
    {
        $this->statusCode = (int) $code;
    }
    
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function getContent()
    {
        return $content;
    }
    
    public function sendJson($statusCode = '', $content = '')
    {
        header("Content-type: text/json; charset=utf-8");
        echo json_encode(['code' => $statusCode ? $statusCode : $this->statusCode, 'content' => $content ? $content : $this->content], JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    public function sendHtml($content = '')
    {
        header("Content-type: text/html; charset=utf-8");
        echo $content ? $content : $this->content;
        exit();
    }
    
    public function sendError($content = '')
    {
        echo $content;
        exit();
    }
    

}


