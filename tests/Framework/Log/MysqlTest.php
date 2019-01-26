<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2019/1/23
 * Time: 21:41
 */

namespace Twinkle\Log;


use App\Model\LogModel;
use PHPUnit\Framework\TestCase;
use Twinkle\Database\Connection;
use Twinkle\Database\DB;
use Twinkle\Library\Config\ConfigLoader;
use Twinkle\Library\Framework\Framework;
use Twinkle\Log\Drivers\Mysql;

class MysqlTest extends TestCase
{

    /**
     * @var LogModel
     */
    protected $logModel = null;

    public function setUp()
    {
        $this->logModel = new LogModel();
        $this->createTable();
    }

    protected function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `log` (
                  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
                  `request_id` varchar(64) NOT NULL DEFAULT '' COMMENT '请求ID',
                  `level` varchar(8) NOT NULL DEFAULT '' COMMENT '错误类型',
                  `location` varchar(128) NOT NULL DEFAULT '' COMMENT '报错位置',
                  `message` varchar(1024) NOT NULL COMMENT '报错日志',
                  `content` text NOT NULL COMMENT '额外信息',
                  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '填加时间',
                  PRIMARY KEY (`id`),
                  KEY `idx_request` (`request_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        $this->logModel->masterDb->execQueryString($sql);
    }

    protected function newLogger()
    {
        return new Logger(new Mysql($this->logModel));
    }

    public function testLog()
    {
        $requestId = Request::singleton()->getRequestId();
        $logger = $this->newLogger();
        $logger->info('testInfo');
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $logger->debug('testDebug', [
            'trace' => $trace
        ]);
        $logList = $this->logModel->getListByRequestId($requestId);
        $this->assertEquals(2, count($logList));
    }

}