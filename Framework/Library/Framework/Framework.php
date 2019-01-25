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
    public $container;

    public static $app;

    final public static function simpleBoot()
    {
        (new static(Container::getInstance()));
    }


    final public static function Bootstrap()
    {
        (new static(Container::getInstance()))->init()->funBoot();
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

        self::$app = $this;
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

    /**
     * @return $this
     */
    protected function init()
    {
        //#自动加载用composer即可
        //暂时先隐藏
        set_error_handler([new \Twinkle\Handler\ErrorHandler(), "handler"]);
        set_exception_handler([new \Twinkle\Handler\ExceptionHandler(), "handler"]);
        register_shutdown_function([new \Twinkle\Handler\ShutdownHandler(), "handler"]);

        #注入系统组件
        $this->container->initializationComponent();

        #注入系统插件
        $this->container->initializationPlugin();

        #加载系统配置
        $this->container->loadSystemConfig();

        return $this;
    }
}

