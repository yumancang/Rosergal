<?php
/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

 
namespace App\Library\Service;

use App\Library\Service\ServiceProvider;
use App\Library\Framework\Container;


class RedisDbServiceProvider extends ServiceProvider
{   
    
    
    public function __construct(Container $container, Array $paramters = [])
    {
        $this->container = $container;
        $this->paramters = $paramters;
    }
    
    public function handler()
    {
        $container = $this->container;
        $paramters = $this->paramters;
        return function()  use($container,$paramters){
            return new \App\Library\Components\RedisComponent($paramters);
        };
    }
    


}

