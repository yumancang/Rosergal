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
use Twinkle\Library\Framework\Container;

class UserToken extends MysqlBase
{

    public $tableName = 'eload_user_token';

    public function updateExpireById($expireTime, $userId)
    {
        $query = $this->masterDb->update($this->tableName, ['expire_time' => $expireTime], "id = ?", [$userId]);

        return $query->rowCount();

    }
}