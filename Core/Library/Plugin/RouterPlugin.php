<?php
namespace App\Library\Plugin;


use App\Library\Framework\Container;
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
