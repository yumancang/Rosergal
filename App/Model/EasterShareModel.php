<?php
namespace Twinkle\Model\Mysql;
 
use Twinkle\Base\Mysql as Mysql;


class EasterShareModel extends Mysql 
{
    public $tableName = 'eload_easter_game_sharelist';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function insertData($data)
    {
        $this->masterDb->insert($this->tableName, $data);
    }
    
    
    
}