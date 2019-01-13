<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2019/1/13
 * Time: 16:05
 */

namespace Twinkle\Library\Model;


use Twinkle\Database\Connection;
use Twinkle\Library\Common\StringHelper;
use Twinkle\Library\Framework\Container;

/**
 * Class Model
 * @package Twinkle\Library\Model
 */
abstract class Model
{

    public $masterDb;

    public $slaveDb;

    public static function tableName()
    {
        return StringHelper::revertUcWords(
            substr(strrchr(get_called_class(), '\\'), 1),
            '_'
        );
    }

    public function __construct()
    {
print_r(static::getConnection());exit(0);
        $this->masterDb = static::getConnection()->getWrite();
        $this->slaveDb = static::getConnection()->getRead();
        exit(0);
    }

    /**
     * @return Connection
     */
    public static function getConnection()
    {
        $container = Container::getInstance();
        return $container['dbService'];
    }

    public function insertData($data)
    {
        return static::getConnection()->getWrite()->insert(static::tableName(), $data);
    }

}