<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/6/7
 * Time: 10:37
 */

namespace Twinkle\Framework;


use Twinkle\Plugin\PluginInterface;

class Hook
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public $plugins = [];
    
    public function __construct()
    {
        
    }
    
    public function registerPlugin($name, PluginInterface $plugin)
    {
        if (isset($this->plugins[$name])) {
            throw new \Exception('registerPlugin error!', '10000');
        }
        $this->plugins[$name] = $plugin;
    }
    
    public function unregisterPlugin($name)
    {
        if (!isset($this->plugins[$name])) {
            throw new \Exception('unregisterPlugin error!', '10001');
        }
        unset($this->plugins[$name]);
    }
    
    public function beforeFramework()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->beforeFramework();
        }
    }
    
    public function afterFramework()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->afterFramework();
        }
    }
    
    public function beforeRouter()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->beforeRouter();
        }
    }
    
    public function afterRouter()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->afterRouter();
        }
    }
    
    public function beforeDispatch()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->beforeDispatch();
        }
    }
    
    public function afterDispatch()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->afterDispatch();
        }
    }
    
    public function beforeView()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->beforeView();
        }
    }
    
    public function afterView()
    {
        foreach ($this->plugins as $plugin) {
            $plugin->afterView();
        }
    }
    
    

    
}
