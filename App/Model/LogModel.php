<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2019/1/25
 * Time: 22:01
 */

namespace App\Model;


use Twinkle\Database\Query;
use Twinkle\Library\Model\Model;

class LogModel extends Model
{

    public function getListByRequestId($requestId)
    {
        return $this->slaveDb->execQuery(
            (new Query())->from(static::tableName())
            ->where('request_id = ?',[$requestId])
            ->orderBy('id ASC')
        )->fetchAll();
    }

}