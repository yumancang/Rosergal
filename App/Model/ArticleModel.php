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


class ArticleModel extends Mysql 
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function getArticleInfo($article_id)
    {
        global $cur_lang, $default_lang;
      
        /* 获得文章的信息 */
        if ($cur_lang == $default_lang) {
            $sql = "SELECT * " .
                "FROM " . ARTICLE . "  " .
                "WHERE is_open = 1 AND platform = 1 AND article_id = ? ";
            
            
            $row = $this->slaveDb->execQuery(
                $this->select('*')
                ->from(ARTICLE)
                ->where("is_open = ? AND platform = ? AND article_id = ?", [1,1,$article_id])
            )->fetchInto(self::FETCH_ASSOC);

            
        } else {
            
            $row = $this->slaveDb->execQuery(
                $this->select('a.*,al.title as title_lang ,al.content as content_lang,al.keywords as keywords_lang
				,al.article_desc as article_desc_lang,al.link as link_lang')
                ->from(ARTICLE . ' as a')
                ->join('LEFT JOIN ' . ARTICLEMUTILANG . ' AS al ON a.article_id=al.article_id')
                ->where("is_open = ? AND platform = ? AND a.article_id = ? AND al.lang = ?", [1,1,$article_id,$cur_lang])
            )->fetchInto(self::FETCH_ASSOC);
            
          
        }
        
      

        
        if ($row !== false) {
            !empty($row['title_lang']) && $row['title'] = $row['title_lang'];
            !empty($row['content_lang']) && $row['content'] = $row['content_lang'];
            !empty($row['keywords_lang']) && $row['keywords'] = $row['keywords_lang'];
            !empty($row['article_desc_lang']) && $row['article_desc'] = $row['article_desc_lang'];
            !empty($row['link_lang']) && $row['link'] = $row['link_lang'];
            $row['add_time'] = local_date($GLOBALS['_CFG']['date_format'], $row['add_time']); // 修正添加时间显示
            $row['content'] = varResume($row['content']);
        }
        
        return $row;
    }

}
