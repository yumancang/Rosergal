<?php
namespace Twinkle\Library\Cache\Driver;
/**
 * Memcached 
 *
 * @author yumancang
 *
 * */
use Twinkle\Library\Cache\CacheAbstract;
class Memcached extends CacheAbstract
{
    public function __construct(array $config)
    {
        parent::__construct($config);
        switch ($config['mode']) {
            case 'memcached':
                goto MEMCACHE_CLUSER;
            case 'memcached_cluser':
                goto MEMCACHE_CLUSER;
            default:
                goto MEMCACHE_EXCEPTION;
        }
        
        MEMCACHE_CLUSER : {
            $this->cache = new \Memcached();
            foreach ($config['config']['servers'] as $val) {
                $persistent = isset($val['persistent']) && $val['persistent'] ? true : null;
                $this->cache->addServer($val['host'], $val['port'], $persistent);
            }

            return true;
        }
        
        MEMCACHE_EXCEPTION : {
            throw new \Exception('没有这种模式', '1001');
        }
    }
    
    
    
    public function set($key, $val, $expire = 0)
    {
        return $this->cache->set($this->getKey($key), $val, $expire);
    }
    
    public function get($key)
    {
        return $this->cache->get($this->getKey($key));
    }
    
    public function delete($key)
    {
        return $this->cache->delete($this->getKey($key));
    }
    
    public function getKey($key)
    {
        return $key;
    }
    
    /**
     * 兼容Memcache没有其他的命令
     * 
     * @param unknown $command
     * @param array $arguments
     * @return boolean
     */
    public function __call($command, array $arguments = [])
    {
        throw new \Exception('命令不匹配',13232);   
    }


}
