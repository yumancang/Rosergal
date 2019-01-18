<?php
namespace Twinkle\Library\Cache\Driver;
/**
 * Redis
 *
 * @author yumancang
 *
 * */
use Twinkle\Library\Cache\CacheAbstract;
/* 
// Simple key -> value set
$redis->set('key', 'value');

// Will redirect, and actually make an SETEX call
$redis->set('key','value', 10);

// Will set the key, if it doesn't exist, with a ttl of 10 seconds
$redis->set('key', 'value', Array('nx', 'ex'=>10));

// Will set a key, if it does exist, with a ttl of 1000 miliseconds
$redis->set('key', 'value', Array('xx', 'px'=>1000));
 */
class Credis extends CacheAbstract
{
    
    public function __construct(array $config)
    {
        parent::__construct($config);
        switch ($config['mode']) {
            case 'credis':
                goto CREDIS;
            case 'redis_replication':
                goto CREDIS_REPLICATION;
            case 'redis_sentinels':
                goto CREDIS_SENTINELS;
            case 'redis_cluser':
                goto CREDIS_CLUSER;
        }
        $config = $config['config'];
        CREDIS : {
            $this->cache = new \Redis();
            $connection = isset($config['persistent']) && $config['persistent']  ? 'pconnect' : 'connect';            
            $timeout = isset($config['timeout']) ? $config['timeout'] : false;
            
            
            $timeout ? $this->cache->$connection($config['host'], $config['port']) :
            $sss = $this->cache->$connection($config['host'], $config['port'], $timeout, NULL, 100);
            
            //是否有密码
            $password = isset($config['password']) ? $config['password'] : '';
            $password && $this->cache->auth($config['password']);
            $database = isset($config['db']) ? $config['db'] : 0;
            $sss = $this->cache->select(12);
            //var_dump($sss);exit();
        }
        CREDIS_REPLICATION : {
        
        }
        CREDIS_SENTINELS : {
        
        }
        CREDIS_CLUSER : {
        
        }        
    }

    public function set($key, $val, $expire = 0)
    {
        $this->cache->set($this->getKey($key), $val);
        if ($expire > 0) {
           $this->cache->expire($this->getKey($key), $expire);
        } 
    }
    
    public function get($key)
    {
        return $this->cache->get($this->getKey($key));
    }
    
    public function hset($key, $field, $value)
    {
        return $this->cache->hset($this->getKey($key), $field, $value);
    }
    
    
    public function hget($key, $field)
    {
        return $this->cache->hget($this->getKey($key), $field);
    }
    
    
    public function delete($key)
    {
        return $this->cache->del($this->getKey($key));
    }
    
    public function getKey($key)
    {
        return $key;
    }
}
