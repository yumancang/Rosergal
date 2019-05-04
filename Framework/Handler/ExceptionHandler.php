<?php
namespace Twinkle\Handler;

/**
 * 异常处理
 *
 * @author yumancang
 *
 * */
class ExceptionHandler extends CommonHandler
{
    public function printException($e)
    {
        $this->info = [
            'message' => 'Uncaught '.get_class($e).', code: ' . $e->getCode() . "<br />Message: " . htmlentities($e->__toString())."\n"
        ];
        $this->end();
    }
     
    public function handler($e)
    {
        self::printException($e);
    }

}
