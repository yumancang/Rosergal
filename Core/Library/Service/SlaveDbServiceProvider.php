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


class SlaveDbServiceProvider extends ServiceProvider
{   
    
    public function __construct()
    {

    }
    
    public function handler()
    {

        return function(){
            \App\Library\Framework\Database\DB::setConfig(array(
                "dsn" => "mysql:host=".DB_HOST_SLAVE_NEW.";port=".DB_HOST_SLAVE_PORT.";dbname=".DB_NAME_SLAVE,
                "username" => DB_USER_SLAVE,
                "password" => DB_PWD_SLAVE
            ),'slave');
            
            return \App\Library\Framework\Database\DB::getInstance("slave");
        };
    }
    


}

