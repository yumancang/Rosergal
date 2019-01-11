<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/5/26
 * Time: 15:47
 */

namespace App\Library\Model\Mysql;


use App\Library\Base\MysqlBase;

class GoodsLabelModel extends MysqlBase
{

    public function updateLabel($goodsId, $labelArr)
    {
        if (empty($goodsId)) {
            return false;
        }
        $this->masterDb->execQueryString('DELETE FROM ' . GOODS_LABEL . " WHERE goods_id = '?'", $goodsId);

        if (empty($labelArr) || !is_array($labelArr)) {
            return false;
        }

        $sql = "INSERT INTO ".GOODS_LABEL."(`goods_id`,`label_id`,`label_name`) VALUES";
        foreach ($labelArr as $label) {
            $sql .= "('{$goodsId}','{$label['id']},'{$label['label_name']}'}'),";
        }
        return $this->masterDb->execQueryString(trim($sql,','));
    }
}