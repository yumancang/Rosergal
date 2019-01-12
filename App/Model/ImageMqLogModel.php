<?php
/**
 * Model
 *
 * DB模型
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */
namespace Twinkle\Model\Mysql;
 
use Twinkle\Base\Mysql as Mysql;


class ImageMqLogModel extends Mysql 
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
