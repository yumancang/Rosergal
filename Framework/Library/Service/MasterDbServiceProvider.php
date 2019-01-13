<?php
/**
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */


namespace Twinkle\Library\Service;

use Twinkle\Database\DB;

class MasterDbServiceProvider extends ServiceProvider
{


    public function __construct()
    {
    }

    public function handler()
    {
        return function()  {
            return new DB([
                "dsn" => "mysql:host=".DB_HOST_NEW.";port=".DB_HOST_PORT.";dbname=".DB_DATABASE,
                "username" => DB_USER,
                "password" => DB_PASSWORD
            ]);
        };
    }



}

