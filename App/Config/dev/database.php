<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2019/1/23
 * Time: 19:32
 */

return [
    'db' => [
        'write' => [
            'dsn' => 'mysql:host=local.test.mysql;port=3306;dbname=db_twinkle',
            'username' => 'db_master_user',
            'password' => 'db_master_pass',
        ],
        'read' => [
            [
                'dsn' => 'mysql:host=local.test.mysql;port=3306;dbname=db_twinkle',
                'username' => 'db_slave_user',
                'password' => 'db_slave_pass',
            ],
            [
                'dsn' => 'mysql:host=local.test.mysql;port=3306;dbname=db_twinkle',
                'username' => 'db_slave_user',
                'password' => 'db_slave_pass',
            ],
        ]
    ]
];