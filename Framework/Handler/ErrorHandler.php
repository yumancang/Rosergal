<?php
namespace Twinkle\Handler;

use Twinkle\Library\Common\Response;

/**
 * 错误处理
 *
 * @author yumancang
 *
 * */
class ErrorHandler extends CommonHandler
{
    
    public function handler($errorNumber, $errorMessage, $errorFile, $errorLine, $errorContext)
    {

        $this->info = [
            'type'    => $errorNumber,
            'message' => $errorMessage,
            'file'    => $errorFile,
            'line'    => $errorLine,
            'context' => $errorContext,
        ];
        
        $this->end();
    }

}
