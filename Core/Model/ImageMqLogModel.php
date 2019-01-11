<?php
/**
 * Model
 *
 * DB模型
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */
namespace App\Library\Model\Mysql;
 
use App\Library\Base\MysqlBase as MysqlBase;


class ImageMqLogModel extends MysqlBase 
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function insertDataBySyn($data)
    {
        $this->masterDb->insert('eload_goods_image_push_mq', $data);
        return $this->masterDb->lastInsertId();
    }

}
