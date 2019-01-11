<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/8/5
 * Time: 11:46
 */

namespace App\Library\Model\Mysql;


use App\Library\Base\MysqlBase;

class TopicModel extends MysqlBase
{

    public $tableName = 'eload_topic';

    public function getTopicInfo($topicId, $fields = '*')
    {
        $sql = "SELECT {$fields} FROM " . $this->tableName . " WHERE id = '{$topicId}'";

        return $this->slaveDb->execQueryString($sql)->fetchInto();
    }

}