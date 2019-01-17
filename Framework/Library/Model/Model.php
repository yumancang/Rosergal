<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2019/1/13
 * Time: 16:05
 */

namespace Twinkle\Library\Model;


use Twinkle\Database\Connection;
use Twinkle\Library\Common\Helper;
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
        return Helper::revertUcWords(
            substr(strrchr(get_called_class(), '\\'), 1),
            '_'
        );
    }

    public function __construct()
    {
        $this->masterDb = static::getConnection()->getWrite();
        $this->slaveDb = static::getConnection()->getRead();
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
        return $this->masterDb->insert(static::tableName(), $data);
    }

}