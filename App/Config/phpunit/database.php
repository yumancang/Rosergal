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
            'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=db_twinkle',
            'username' => 'root',
        ],
        'read' => [
            [
                'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=db_twinkle',
                'username' => 'travis',
            ],
            [
                'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=db_twinkle',
                'username' => 'travis',
            ],
        ]
    ]
];