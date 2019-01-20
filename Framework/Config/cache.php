<?php
/**
 * 框架基础配置
 * 应用层相同配置会直接覆盖
 * 
 * @author  yumancang
 */
return [
    #credis,credis_replication,redis-sentinels,redis-cluser,
    #predis,predis_replication,predis-sentinels,predis-cluser
    #memcache,memcache_cluser
    
    #当前用的驱动
    'driver' => 'credis',    
    
    /***********php-redis**************/
    #单主机
    /* 'credis' => [
        'mode' => 'credis',
        'config' => [
            'host' => '192.168.0.103',
            'port' => '6379',
            'persistent' => true,
            'username'  => false,
            'password'  => false,
            'database'  => 15,
            'timeout'   => false,
        ],
    ], */
    
    #redis 一主多从
    'credis' => [
        'mode' => 'credis_replication',
        'config' => [
            'master' => [
                [
                'host' => '192.168.0.103',
                'port' => '6379',
                'persistent' => true,
                'username'  => false,
                'password'  => false,
                'database'  => 15,
                'timeout'   => false,
                ]
            ],
            'slave' => [
                [
                    'host' => '192.168.0.103',
                    'port' => '6379',
                    'persistent' => true,
                    'username'  => false,
                    'password'  => false,
                    'database'  => 15,
                    'timeout'   => false
                ],
                [
                    'host' => '192.168.0.103',
                    'port' => '6379',
                    'persistent' => true,
                    'username'  => false,
                    'password'  => false,
                    'database'  => 15,
                    'timeout'   => false
                ],
                [
                    'host' => '192.168.0.103',
                    'port' => '6379',
                    'persistent' => true,
                    'username'  => false,
                    'password'  => false,
                    'database'  => 15,
                    'timeout'   => false
                ]
            ]
        ],
    ],
    
    /*********predis**********/
    #哨兵 predis 包里面自己实现主从切换
    'predis' => [
        'mode' => 'predis_sentinels', #模式
        'config' => [
            'sentinels' => [
                '10.60.46.196:6383',
                '10.60.46.195:6385',
                '10.60.46.196:6384'
            ],
            'options' => [
                'replication' => 'sentinel', 
                'service' => 'sentinel-10.60.46.195-6384'
            ],
        ],
    ],
    
    /*********memcache**********/
    #memcache,memcache_cluser
    'memcache' => [
        'mode' => 'memcache', #模式
        'config' => [
            'servers' => [
                ['host' => '127.0.0.1','port' => '11211', 'persistent' => true],
            ],
            'options' => [
                'compress' => true  #是否压缩
            ],
        ],
    ],
    
    
    /* 'memcache' => [
        'mode' => 'memcache_cluser', #模式
        'config' => [
            'servers' => [
                '10.60.46.196:6383'
            ],
            'options' => [
                'replication' => 'sentinel',
                'service' => 'sentinel-10.60.46.195-6384'
            ],
        ],
    ], */
    
    /*********predis**********/
    #单主机
    /* 'predis' => [
        'mode' => 'redis', #模式
        'sentinels' => [
            'tcp://10.0.0.1?alias=master',
            'tcp://10.0.0.2',
            'tcp://10.0.0.3'
        ],
        'options' => [
            'replication' => 'sentinel',
            'service' => 'mymaster'
        ],
    ],
    #主从
    'predis' => [
        'mode' => 'redis-replication', #模式
        'sentinels' => [
            'tcp://10.0.0.1?alias=master', 
            'tcp://10.0.0.2', 
        'tcp://10.0.0.3'
        ],
        'options' => [
            'replication' => 'sentinel', 
            'service' => 'mymaster'
        ],
    ],
    #哨兵
    'predis' => [
        'mode' => 'redis-sentinel', #模式
        'sentinels' => ['tcp://10.0.0.1', 'tcp://10.0.0.2', 'tcp://10.0.0.3'],
        'options' => ['replication' => 'sentinel', 'service' => 'mymaster'],
    ],
    #分布式
    'predis' => [
        'mode' => 'redis-cluster', #模式
        'sentinels' => ['tcp://10.0.0.1', 'tcp://10.0.0.2', 'tcp://10.0.0.3'],
        'options' => ['replication' => 'sentinel', 'service' => 'mymaster'],
    ] */
     
];