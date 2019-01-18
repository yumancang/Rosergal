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
    public $predis;
    
    public function __construct()
    {
        
    }
    
    public function connect()
    {
        
    }
    
    public function set($key, $val)
    {
        prend($key, $val);
    }
}
