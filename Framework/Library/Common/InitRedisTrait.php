<?php

/**
 * 复件 
 * 提高代码的复用率
 * @author Python Luo <laifaluo@126.com>
 *
 * */
 

namespace Twinkle\Common;


trait InitRedisTrait 
{
    
    public $redis;
    
    public function initRedis() 
    {
        $this->redis = get_redis_obj(['namePrefix' => 'ROSEGAL_']);
    }
}






