<?php
/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

 
namespace Twinkle\Library\Service;

use Twinkle\Library\Service\ServiceProvider;
use Twinkle\Library\Framework\Container;


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

