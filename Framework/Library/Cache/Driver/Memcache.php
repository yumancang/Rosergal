<?php
namespace Twinkle\Library\Cache\Driver;
/**
 * Memcache 不压缩
 *
 * @author yumancang
 *
 * */
use Twinkle\Library\Cache\CacheAbstract;
class Memcache extends CacheAbstract
{
    private $compress;
    
    public function __construct(array $config)
    {
        parent::__construct($config);
        switch ($config['mode']) {
            case 'memcache':
                goto MEMCACHE_CLUSER;
            case 'memcache_cluser':
                goto MEMCACHE_CLUSER;
            default:
                goto MEMCACHE_EXCEPTION;
        }
        
        MEMCACHE_CLUSER : {
            $this->cache = new \Memcache();
            foreach ($config['config']['servers'] as $val) {
                $persistent = isset($val['persistent']) && $val['persistent'] ? true : null;
                $this->cache->addServer($val['host'], $val['port'], $persistent);
            }
            
            $this->compress = isset($config['config']['options']['compress']) 
            && $config['config']['options']['compress'] ? MEMCACHE_COMPRESSED : null;
            return true;
        }
        
        MEMCACHE_EXCEPTION : {
            throw new \Exception('没有这种模式', '1001');
        }
    }
    
    public function set($key, $val, $expire = 0)
    {
        return $this->cache->set($this->getKey($key), $val, $this->compress, $expire);
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

}
