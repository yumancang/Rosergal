<?php
/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

 
namespace App\Library\Service;
use App\Library\Framework\Database\DB as DB;
use App\Library\Base\ServiceProviderBase as ServiceProviderBase;
use App\Library\Framework\Container;


class MasterDbServiceProvider extends ServiceProvider
{   
    
    
    public function __construct()
    {
    }
    
    public function handler()
    {
        return function()  {
            \App\Library\Framework\Database\DB::setConfig(array(
                "dsn" => "mysql:host=".DB_HOST_NEW.";port=".DB_HOST_PORT.";dbname=".DB_DATABASE,
                "username" => DB_USER,
                "password" => DB_PASSWORD
            ),'master');
            return \App\Library\Framework\Database\DB::getInstance("master");
        };
    }
    


}

