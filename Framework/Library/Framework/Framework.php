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
     * 全局容器
     * @var Container
     */
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

        //#自动加载用composer即可
        //暂时先隐藏
        set_error_handler([new \Twinkle\Handler\ErrorHandler(), "handler"]);
        set_exception_handler([new \Twinkle\Handler\ExceptionHandler(), "handler"]);
        register_shutdown_function([new \Twinkle\Handler\ShutdownHandler(), "handler"]);

        #注入系统组件
        $RContainer->initializationComponent();

        #注入系统插件
        $RContainer->initializationPlugin();
        
        #加载系统配置
        $RContainer->loadSystemConfig();
        
        
        
        $this->init();
    }

    /**
     * 前台AJAX入口
     */
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

