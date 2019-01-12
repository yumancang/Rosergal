<?php
/**
 * 定时任务脚本可以继承的类
 * 提高代码的复用率
 * @author Python Luo <laifaluo@126.com>
 * 
 * */
namespace Twinkle\Library\Common;


class InitdbBase
{
    
    use InitdbTrait;
    
    
    public function __construct() 
    {
        $this->initDb();
    }
}






