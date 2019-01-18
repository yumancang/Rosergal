<?php
namespace Twinkle\Library\Cache\Driver;
/**
 * Redis - PRedis composer包
 * 只做应用层最原始数据的
 * JSON或者序列化的操作在调用之前执行
 *
 * @author yumancang
 *
 * */
use Twinkle\Library\Cache\CacheAbstract;
class Predis extends CacheAbstract
{
    
    public function __construct(array $config)
    {
        parent::__construct($config);
        switch ($config['mode']) {
            case 'predis':
                goto PREDIS;
            case 'predis_replication':
                goto PREDIS_REPLICATION;
            case 'predis_sentinels':
                goto PREDIS_SENTINELS;
            case 'predis_cluser':
                goto PREDIS_CLUSER;
        }
        PREDIS : {
            return true;
        }
        PREDIS_REPLICATION : {
            return true;
        }
        PREDIS_SENTINELS : {
            $this->cache = new \Predis\Client($config['config']['sentinels'], $config['config']['options']);
            return true;
        }
        PREDIS_CLUSER : {
            return true;
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
