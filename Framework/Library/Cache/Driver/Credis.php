<?php
namespace Twinkle\Library\Cache\Driver;
/**
 * Redis
 * 
 * @author yumancang
 *
 * */
use Twinkle\Library\Cache\CacheAbstract;

class Credis extends CacheAbstract
{
    
    public function __construct(array $config)
    {
        parent::__construct($config);
        $mode = $config['mode'];
        $config = $config['config'];
       
        switch ($mode) {
            case 'credis':
                goto CREDIS;
            case 'credis_replication':
                goto CREDIS_REPLICATION;
            case 'credis_sentinels':
                goto CREDIS_SENTINELS;
            case 'credis_cluser':
                goto CREDIS_CLUSER;
        }
        
        CREDIS : {
        }
        CREDIS_REPLICATION : {

        }
        CREDIS_SENTINELS : {
        
        }
        CREDIS_CLUSER : {
        
        }        
    }
    

    public function connectInitHostProt($config)
    {
        $this->cache = new \Redis();
        $connection = isset($config['persistent']) && $config['persistent']  ? 'pconnect' : 'connect';
        $timeout = isset($config['timeout']) ? $config['timeout'] : false;
        $timeout ? $sss = $this->cache->$connection($config['host'], $config['port']) :
        $sss = $this->cache->$connection($config['host'], $config['port'], $timeout, NULL, 100);
        //是否有密码
        $password = isset($config['password']) ? $config['password'] : '';
        $password && $this->cache->auth($config['password']);
        $database = isset($config['db']) ? $config['db'] : 0;
        $this->cache->select($database);
    }
    
    public function pickupMaster()
    {
        if ($this->serverConfig['mode'] == 'credis_replication') {
            $count = count($this->serverConfig['config']['master']);
            $index = rand(0,$count-1);
            $redisConfig = $this->serverConfig['config']['master'][$index];
        }
        if ($this->serverConfig['mode'] == 'credis') {
            $redisConfig = $this->serverConfig['config'];
        }
        return $redisConfig;
    }
    
    public function pickupSlave()
    {
        if ($this->serverConfig['mode'] == 'credis_replication') {
            $count = count($this->serverConfig['config']['slave']);
            $index = rand(0,$count-1);
            $redisConfig = $this->serverConfig['config']['slave'][$index];
        }
        
        if ($this->serverConfig['mode'] == 'credis') {
            $redisConfig = $this->serverConfig['config'];
        }
        return $redisConfig;
    }
    
    
    public function ping()
    {
        $pong = [];
        $this->connectInitHostProt($this->pickupMaster());
        $pong[] = $this->cache->ping();
        $this->connectInitHostProt($this->pickupSlave());
        $pong[] = $this->cache->ping();
        return $pong;
    }
    
    public function expire($key, $expire)
    {
        $this->connectInitHostProt($this->pickupMaster());
        if ($expire === 0) {
            throw new \Exception('time error!',10002);
        }
        return $this->cache->expire($this->getKey($key), $expire);
    }

    public function set($key, $val, $expire = 0)
    {
        $this->connectInitHostProt($this->pickupMaster());
        $this->cache->set($this->getKey($key), $val);
        if ($expire > 0) {
           $this->cache->expire($this->getKey($key), $expire);
        }
        return true;
    }
    
    public function get($key)
    {
        $this->connectInitHostProt($this->pickupSlave());
        return $this->cache->get($this->getKey($key));
    }
    
    public function hset($key, $field, $value, $expire = 0)
    {
        $this->connectInitHostProt($this->pickupMaster());
        $this->cache->hset($this->getKey($key), $field, $value);
        if ($expire > 0) {
            $this->cache->expire($this->getKey($key), $expire);
        } 
        return true;
    }
    
    
    public function hget($key, $field)
    {
        $this->connectInitHostProt($this->pickupSlave());
        return $this->cache->hget($this->getKey($key), $field);
    }
    
    
    public function delete($key)
    {
        $this->connectInitHostProt($this->pickupMaster());
        return $this->cache->del($this->getKey($key));
    }
    
    public function getKey($key)
    {
        return $key;
    }
    
    
    /**
     * 兼容没有其他的命令
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
