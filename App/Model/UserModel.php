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

use Twinkle\Library\Model\Model;

class UserModel extends Model
{

    public static function tableName()
    {
        return 'eload_users';
    }

    public function getUserInfo()
    {

        return ['yumangc'];
    }
}