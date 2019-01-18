<?php
namespace Twinkle\Library\Cache\Driver;
/**
 * Redis - PRedis composer包
 *
 * @author yumancang
 *
 * */
use Twinkle\Library\Cache\CacheAbstract;
class Predis extends CacheAbstract
{
    private $predis;
    
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
