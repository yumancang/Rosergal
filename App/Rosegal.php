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
use Twinkle\Log\Drivers\File;
use Twinkle\Log\Logger;

/**
 * Class Rosegal
 * @package App
 */
class Rosegal extends Framework
{

    protected function preInit()
    {
        define('APP_PATH', __DIR__);

        $this->container->injection('fileLogger', new Logger(new File([
            'logPath' => ROOT_PATH . '/Runtime/logs',
            'logFile' => 'app.log',
            'useBuffer' => false,
            'bufferSize' => 10,
            'rotate' => 'day',
        ])));

        parent::preInit();
    }

    protected function init()
    {
        parent::init();

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

        return $this;
    }

    public function getLogger()
    {
        return $this->container->get('fileLogger');
    }

}
