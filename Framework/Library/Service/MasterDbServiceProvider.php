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


class MasterDbServiceProvider extends ServiceProvider
{   
    
    
    public function __construct()
    {
    }
    
    public function handler()
    {
        return function()  {
            \Twinkle\Library\Framework\Database\DB::setConfig(array(
                "dsn" => "mysql:host=".DB_HOST_NEW.";port=".DB_HOST_PORT.";dbname=".DB_DATABASE,
                "username" => DB_USER,
                "password" => DB_PASSWORD
            ),'master');
            return \Twinkle\Library\Framework\Database\DB::getInstance("master");
        };
    }
    


}

