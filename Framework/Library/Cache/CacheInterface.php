<?php
namespace Twinkle\Library\Cache;
/**
 * 缓存接口
 *
 * @author yumancang
 *
 * */
interface CacheInterface
{
    public function set($key, $val, $expire = 0);
    
    public function get($key);
    
    public function delete($key);
    
    public function getKey($key);
}
