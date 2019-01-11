<?php
/**
 * RGPC应用实例
 * 
 * @author yumancang
 *
 * */
namespace App\Library\Framework;

use InvalidArgumentException;

use App\Library\Framework\Container;
use App\Library\Framework\Pipeline;
use App\Library\Framework\Framework;
use App\Library\Framework\Router;
use App\Library\Framework\Dispatch;
use App\Library\Framework\View;
use App\Library\Config\ConfigLoader;

class Rosegal
{
    /**
     *
     * 全局容器
     *
     * */
    private $container;
    
    
    
    public  static function Bootstrap()
    {
       
        (new self(Container::getInstance()))->funBoot();
    }
    
    /**
     *
     * 构造函数
     * @param object $RContainer
     * @return void
     *
     * */
    private function __construct(Container $RContainer = null)
    {
        
        define('FRAMEWORK_PATH', str_replace('/Library/Framework/Rosegal.php', '', str_replace('\\', '/', __FILE__)));
        
        $this->container = $RContainer;
        
        #自定义错误异常处理
        /* set_error_handler(function(){
            
        });
        set_exception_handler(function(){
            
        });
        register_shutdown_function(function(){
            
        });
        spl_autoload_register(function(){
            
        }); */
        
        #注入系统组件
        $RContainer->initializationComponent();
        
        #注入系统插件
        $RContainer->initializationPlugin();
        
        #注入业务组件
        
        ConfigLoader::LoadConfig(FRAMEWORK_PATH . '/Config','alias_class.php');
        foreach (ConfigLoader::$Config['alias_class.php'] as $name => $classname) {
            $RContainer->make($name, $classname);
        }
        
        #注入业务插件
        ConfigLoader::LoadConfig(FRAMEWORK_PATH . '/Config','plugin.php');
        foreach (ConfigLoader::$Config['plugin.php'] as $configFilename => $pluginClassPath) {
            Hook::getInstance()->registerPlugin($configFilename, new $pluginClassPath());
        }

    }
    /**
     * 
     * 前台AJAX入口
     * @param object $RContainer
     * @return void
     * 
     * */
    private function funBoot()
    {
        (new Pipeline())
        
        ->pipe(Hook::getInstance()->beforeFramework())
        ->pipe(Framework::getInstance())
        ->pipe(Hook::getInstance()->afterFramework())
        
        ->pipe(Hook::getInstance()->beforeRouter())
        ->pipe(Router::getInstance())
        ->pipe(Hook::getInstance()->afterRouter())
        
        ->pipe(Hook::getInstance()->beforeDispatch())
        ->pipe(Dispatch::getInstance())
        ->pipe(Hook::getInstance()->afterDispatch())
        
        ->pipe(Hook::getInstance()->beforeView())
        ->pipe(View::getInstance())
        ->pipe(Hook::getInstance()->afterView())
        
        ->process();
    }


}

