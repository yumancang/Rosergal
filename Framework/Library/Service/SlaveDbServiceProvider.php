<?php
/**
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */


namespace Twinkle\Library\Service;

use Twinkle\Database\DB;

class SlaveDbServiceProvider extends ServiceProvider
{

    public function __construct()
    {

    }

    public function handler()
    {

        return function () {
            return new DB([
                "dsn" => "mysql:host=" . DB_HOST_SLAVE_NEW . ";port=" . DB_HOST_SLAVE_PORT . ";dbname=" . DB_NAME_SLAVE,
                "username" => DB_USER_SLAVE,
                "password" => DB_PWD_SLAVE
            ]);
        };


    }


}

