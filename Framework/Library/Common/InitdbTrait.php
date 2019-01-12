<?php

/**
 * 复件 
 * 提高代码的复用率
 * @author Python Luo <laifaluo@126.com>
 *
 * */
 

namespace Twinkle\Library\Common;


trait InitdbTrait 
{
    
    public $slaveDb;
    
    public $masterDb;
    
    public $forSize = 5000;
    
    public function initDb() 
    {
        $this->slaveDb = get_slave_db();
        $this->masterDb = $GLOBALS['db'];
    }
}






