<?php
/**
 * 框架基础配置
 * 应用层相同配置会直接覆盖
 * 
 * @author  yumancang
 */
return [
    #单主机
    'predis' => [
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
    ]
     
];