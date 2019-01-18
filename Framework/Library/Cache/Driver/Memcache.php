<?php
namespace Twinkle\Library\Cache\Driver;
/**
 * Memcache
 *
 * @author yumancang
 *
 * */
use Twinkle\Library\Cache\CacheAbstract;
class Memcache extends CacheAbstract
{
    private $memcache;
    
    public function __construct(array $config)
    {
    
    }
    
    public function set($key, $val, $expire = 0)
    {
    
    }
    
    public function get($key)
    {
    
    }
    
    public function delete($key)
    {
    
    }
    
    public function getKey($key)
    {
    
    }
}
