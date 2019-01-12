<?php
/**
 * Model
 *
 * DB模型
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */
 
namespace App\Model;
 
use Twinkle\Library\Database\Mysql as Mysql;

class UserModel extends Mysql 
{
    
    public $tableName = 'eload_users';
    
    public function __construct()
    {
       
       parent::__construct();
    }

    
    public function getUserInfo()
    {
        
        return ['yumangc'];
    }

}