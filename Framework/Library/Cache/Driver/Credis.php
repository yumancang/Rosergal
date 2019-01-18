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
    private $phpredis;
    
    public function __construct(array $config)
    {
        
        if (!isset($config['mode'])) {
            throw new \Exception('配置没有选择模式', '1001');
        }

        if ( !extension_loaded('redis') ) {
            throw new \Exception('php-redis 拓展未加载', '1001');
        }
        
        $config = $config['config'];
        
        switch ($config) {
            case 'credis':
                goto CREDIS;
            case 'redis_replication':
                goto CREDIS_REPLICATION;
            case 'redis_sentinels':
                goto CREDIS_SENTINELS;
            case 'redis_cluser':
                goto CREDIS_CLUSER;
        }
        
        CREDIS : {
            $this->phpredis = new \Redis();
            $connection = isset($config['persistent']) && $config['persistent']  ? 'pconnect' : 'connect';            
            $timeout = isset($config['timeout']) ? $config['timeout'] : false;
            
            
            $timeout ? $this->phpredis->$connection($config['host'], $config['port']) :
            $sss = $this->phpredis->$connection($config['host'], $config['port'], $timeout, NULL, 100);
            
            //是否有密码
            $password = isset($config['password']) ? $config['password'] : '';
            $password && $this->phpredis->auth($config['password']);
            $database = isset($config['db']) ? $config['db'] : 0;
            $sss = $this->phpredis->select(12);
            //var_dump($sss);exit();
        }
        CREDIS_REPLICATION : {
        
        }
        CREDIS_SENTINELS : {
        
        }
        CREDIS_CLUSER : {
        
        }        
    }

    public function set($key, $val, $expire = 3)
    {
        //prend($this->getKey($key), $val, $expire);
        $aaa = $this->phpredis->set($this->getKey($key), $val, $expire);
        var_dump($aaa);exit();
    }
    
    public function get($key)
    {
        return $this->phpredis->get($this->getKey($key));
    }
    
    public function delete($key)
    {
        return $this->phpredis->delete($this->get($key));
    }
    
    public function getKey($key)
    {
        return $key;
    }
}
