<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2019/1/12
 * Time: 19:53
 */

namespace App\Component\Log\Format;


use Twinkle\Log\Format\FileLine;

class KernelBusMonitorLine extends FileLine
{

    public function __construct($message, $location, $level, $content, $createTime)
    {
        parent::__construct($message, $location, $level, $content, $createTime);
    }

    public function format()
    {

    }

}