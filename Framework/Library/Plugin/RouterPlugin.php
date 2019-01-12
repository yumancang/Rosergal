<?php
namespace Twinkle\Library\Plugin;


use Twinkle\Library\Framework\Container;
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
