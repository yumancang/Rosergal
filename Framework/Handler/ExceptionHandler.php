<?php
namespace Twinkle\Handler;

use Exception;
use Twinkle\Library\Common\Response;
/**
 * 异常处理
 *
 * @author yumancang
 *
 * */
class ExceptionHandler extends CommonHandler
{
    public function printException(Exception $e)
    {
        $this->info = [
            'message' => 'Uncaught '.get_class($e).', code: ' . $e->getCode() . "<br />Message: " . htmlentities($e->__toString())."\n"
        ];
        $this->end();
    }
     
    public function handler(Exception $e)
    {
        
        self::printException($e);
    }

}
