<?php
/**
 * RGPC应用实例
 *
 * @author yumancang
 *
 * */
namespace App;

use Twinkle\Library\Config\ConfigLoader;
use Twinkle\Library\Framework\Framework;
use Twinkle\Library\Framework\Hook;

class Rosegal extends Framework
{

    protected function preInit()
    {
        echo 111;
        define('APP_PATH', __DIR__);
    }

    protected function init()
    {
        #注入业务组件
        ConfigLoader::LoadConfig(APP_PATH . '/Config', 'alias_class.php');
        foreach (ConfigLoader::$Config['alias_class.php'] as $name => $classname) {
            $this->container->make($name, $classname);
        }

        #注入业务插件
        ConfigLoader::LoadConfig(APP_PATH . '/Config', 'plugin.php');
        foreach (ConfigLoader::$Config['plugin.php'] as $configFilename => $pluginClassPath) {
            Hook::getInstance()->registerPlugin($configFilename, new $pluginClassPath());
        }
    }

}

