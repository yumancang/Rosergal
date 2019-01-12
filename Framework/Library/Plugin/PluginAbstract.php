<?php
namespace Twinkle\Library\Plugin;

abstract class PluginAbstract implements PluginInterface
{
    public function beforeFramework(){}
    
    public function afterFramework(){}
    
    public function beforeRouter(){}
    
    public function afterRouter(){}
    
    public function beforeDispatch(){}
    
    public function afterDispatch(){}
    
    public function beforeView(){}
    
    public function afterView(){}
}
