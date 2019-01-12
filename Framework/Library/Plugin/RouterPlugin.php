<?php
namespace Twinkle\Plugin;


use Twinkle\Framework\Container;
class RouterPlugin extends PluginAbstract
{
    public function beforeRouter()
    {
        Container::getInstance()->initializationService();
    }
    
    public function afterRouter()
    {
    
    }
}
