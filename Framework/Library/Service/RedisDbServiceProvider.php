<?php
/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

 
namespace Twinkle\Service;

use Twinkle\Service\ServiceProvider;
use Twinkle\Framework\Container;


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
            return new \Twinkle\Components\RedisComponent($paramters);
        };
    }
    


}

