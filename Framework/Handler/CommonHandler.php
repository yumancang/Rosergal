<?php
namespace Twinkle\Handler;

use Twinkle\Library\Common\Response;
use Twinkle\Library\Framework\Container;


/**
 * 错误处理
 *
 * @author yumancang
 *
 * */
class CommonHandler
{
    public $info;
    
    /**
     * 脚本结束
     *
     * @return　mixed
     */
    protected function end()
    {
        //Container::getInstance()['fileLogger']->info(json_encode($this->info));
        Response::getInstance()->sendError($this->info);
    }
}
