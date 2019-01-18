<?php
return [
    'redis' => [
        'mode' => 'redis-replication', #模式
        'sentinels' => ['tcp://10.0.0.1?alias=master', 'tcp://10.0.0.2', 'tcp://10.0.0.3'],
        'options' => ['replication' => 'sentinel', 'service' => 'mymaster'],
    ],
    /*
     * 'redis' => [
        'mode' => 'redis-sentinel', #模式
        'sentinels' => ['tcp://10.0.0.1', 'tcp://10.0.0.2', 'tcp://10.0.0.3'],
        'options' => ['replication' => 'sentinel', 'service' => 'mymaster'],
    ]
    ],
     * */
];