<?php
namespace Twinkle\Handler;

use Exception;

class ExceptionHandler 
{
    public static function printException(Exception $e)
    {
        print 'Uncaught '.get_class($e).', code: ' . $e->getCode() . "<br />Message: " . htmlentities($e->__toString())."\n";
    }
     
    public static function handleException(Exception $e)
    {
        
        self::printException($e);
    }
}
