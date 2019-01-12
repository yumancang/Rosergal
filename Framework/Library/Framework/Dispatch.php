<?php
/**
 * 路由分发
 * @author yumancang <laifaluo@126.com>
 *
 * */
namespace Twinkle\Library\Framework;

use Twinkle\Library\Common\Response;
use Twinkle\Library\Common\Request;
class Dispatch
{
    
    private static $_instance = null;
    
    public $response;

    
    private function __construct() 
    {
        
        $this->response = Response::getInstance();
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
        $router = Router::getInstance();
        $controllerName = 'App\Controller\\'.ucfirst($router->module).'Controller';
        
        try {
            call_user_func([new  $controllerName(), $router->action], $router->request);
        } catch (\Exception $e) {
        }
       
    }
    
    /* public function handler()
    {
        $router = Router::getInstance();
        
        try {
            $data = call_user_func([$router->module , $router->action], $router->request);
            $this->response->setStatusCode(Response::HTTP_OK);
            $this->response->setContent(['data' => $data['data'],'msg' => $data['msg']]);
            goto ASYNC_SEND;
        
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            $this->response->setContent(['data' => null,'msg' => $e->getMessage()]);
            goto ASYNC_SEND;
        }
        ASYNC_SEND : {
            $this->response->sendJson();
        }
    } */

}

