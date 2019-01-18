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
    public function set($key, $val, $expire = 0){}
    
    public function get($key){}
    
    public function delete($key){}
    
    public function getKey($key){}

}
