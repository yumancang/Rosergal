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
 
use Twinkle\Base\MysqlBase as MysqlBase;


class ArticleCatModel extends MysqlBase 
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function getCatArticleList($cat_id = 0, $parent_id = 10)
    {
        
        $data = $this->slaveDb->execQuery(
            $this->select('cat_id,cat_name')
            ->from(ARTICLECAT)
            ->where("parent_id = ?", [$parent_id])
            ->orderBy('sort_order ASC')
        )->fetchAll(self::FETCH_ASSOC);

        if ($cat_id != 0) {
            $data = $this->slaveDb->execQuery(
                $this->select('cat_id,cat_name')
                ->from(ARTICLECAT)
                ->where("cat_id = ?", [$cat_id])
                ->orderBy('sort_order ASC')
            )->fetchAll(self::FETCH_ASSOC);
        }
   
        return $data;

    }

}
