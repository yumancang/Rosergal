<?php
namespace Twinkle\Handler;

use Twinkle\Library\Common\Response;
/**
 * 关闭处理
 *
 * @author yumancang
 *
 * */
class ShutdownHandler extends CommonHandler
{
    public function handler()
    {
        
        $error = error_get_last();
        if (empty($error)) {
            return;
        }
        $this->info = [
            'type'    => $error['type'],
            'message' => $error['message'],
            'file'    => $error['file'],
            'line'    => $error['line'],
        ];
        
        $this->end();
    }

}
