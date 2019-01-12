<?php
/**
 * RGPC应用实例
 *
 * @author yumancang
 *
 * */
namespace Twinkle\Library\Framework;


class Framework
{
    /**
     *
     * 全局容器
     *
     * */
    protected $container;


    final public static function Bootstrap()
    {
        (new static(Container::getInstance()))->funBoot();
    }

    /**
     *
     * 构造函数
     * @param Container $RContainer
     *
     * */
    private function __construct(Container $RContainer = null)
    {
        $this->container = $RContainer;

        $this->preInit();

        define('FRAMEWORK_PATH', str_replace('/Library/Framework/Framework.php', '', str_replace('\\', '/', __FILE__)));

        $RContainer['fileLogger']->info('Framework:__construct');

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

        $this->init();
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

    protected function preInit()
    {

    }

    protected function init()
    {

    }
}

