<?php
namespace Twinkle\Library\Cache;
/**
 * 缓存抽象层
 * 
 * @author yumancang 
 *
 * */
abstract class CacheAbstract implements CacheInterface
{
    protected $cache;
    
    protected $serverConfig;
    
    public function set($key, $val, $expire = 0){}
    
    public function get($key){}
    
    public function delete($key){}
    
    public function getKey($key){}
    
    public function __construct(array $config)
    {
        $this->serverConfig = $config;
        if (!isset($config['mode'])) {
            throw new \Exception('配置没有选择模式', '1001');
        }
        
        if (!isset($config['config'])) {
            throw new \Exception('配置没有选择数据', '1001');
        }
    }
}
