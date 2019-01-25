<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2019/1/23
 * Time: 13:50
 */

namespace Twinkle\Database;


use Twinkle\Database\Exception\NotFoundException;
use Twinkle\Library\Config\ConfigLoader;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{

    protected $master;

    protected $slaves = [];

    public function setUp()
    {
        if (!extension_loaded('pdo_mysql')) {
            $this->markTestSkipped("Need 'pdo_mysql' extension to test mysql.");
        }

        $database = ConfigLoader::$Config['database.php']['db'];
        $this->master = function () use ($database) {
            return new DB($database['write']);
        };

        $slave1 = function () use ($database) {
            return new DB($database['read'][0]);
        };
        $slave2 = function () use ($database) {
            return new DB($database['read'][1]);
        };
        $this->slaves = [
            'slave1' => $slave1,
            'slave2' => $slave2
        ];
    }

    public function newConnection()
    {
        return new Connection($this->master, $this->slaves);
    }

    public function testGetWrite()
    {
        $connection = $this->newConnection();
        $expect = call_user_func($this->master);
        $this->assertEquals($expect, $connection->getWrite());
        $this->assertInstanceOf(DB::class, $connection->getWrite());
    }

    public function testGetRead()
    {
        $connection = $this->newConnection();
        $expect1 = call_user_func($this->slaves['slave1']);
        $expect2 = call_user_func($this->slaves['slave2']);
        $this->assertEquals($expect1, $connection->getRead('slave1'));
        $this->assertEquals($expect2, $connection->getRead('slave2'));
    }

    public function testGetReadRandom()
    {
        $connection = $this->newConnection();
        $expect1 = call_user_func($this->slaves['slave1']);
        $expect2 = call_user_func($this->slaves['slave2']);
        $expect = [
            $expect1->username,
            $expect2->username,
        ];
        for ($i = 1; $i <= 10; $i++) {
            $actual = $connection->getRead();
            $this->assertTrue(in_array($actual->username, $expect));
        }
    }

    public function testGetReadMissing()
    {
        $connection = $this->newConnection();
        $this->expectException(NotFoundException::class);
        $connection->getRead('slave3');
    }

}