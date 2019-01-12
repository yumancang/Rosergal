<?php
/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

 
namespace Twinkle\Library\Service;
use Twinkle\Library\Framework\Database\DB as DB;
use Twinkle\Base\ServiceProviderBase as ServiceProviderBase;
use Twinkle\Library\Framework\Container;


class SlaveDbServiceProvider extends ServiceProvider
{   
    
    public function __construct()
    {

    }
    
    public function handler()
    {

        return function(){
            \Twinkle\Library\Framework\Database\DB::setConfig(array(
                "dsn" => "mysql:host=".DB_HOST_SLAVE_NEW.";port=".DB_HOST_SLAVE_PORT.";dbname=".DB_NAME_SLAVE,
                "username" => DB_USER_SLAVE,
                "password" => DB_PWD_SLAVE
            ),'slave');
            
            return \Twinkle\Library\Framework\Database\DB::getInstance("slave");
        };
    }
    


}

