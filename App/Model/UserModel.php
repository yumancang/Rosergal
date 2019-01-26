<?php
/**
 * Model
 *
 * DB模型
 *
 * @author Python Luo <laifaluo@126.com>
 *
 * */

namespace App\Model;

use Twinkle\Database\Query;
use Twinkle\Library\Model\Model;

class UserModel extends Model
{

    public static function tableName()
    {
        return 'eload_users';
    }

    public function getUserInfo()
    {
        return $this->slaveDb->execQuery(
            (new Query())->select('user_id,email')
                ->from(static::tableName())
                ->where('user_id = ?',1992)
                ->limit(1)
        )->fetchInto();
    }
}