<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2019/1/23
 * Time: 21:41
 */

namespace Twinkle\Log;


use App\Rosegal;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use Twinkle\Log\Drivers\File;

class LoggerTest extends TestCase
{

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var File
     */
    protected $storage;

    public function setUp()
    {
        $this->storage = new File([
            'logPath' => ROOT_PATH . '/Runtime/logs',
            'logFile' => 'app.log',
            'useBuffer' => false,
            'bufferSize' => 10,
            'rotate' => 'day',
        ]);
        $this->logger = new Logger($this->storage);
    }

    public function testInfo()
    {
        $requestId = Request::singleton()->getRequestId();

        $this->logger->info('testInfo');
        $this->assertFileExists($this->storage->logFile);
        $logContent = file_get_contents($this->storage->logFile);
        $this->assertContains($requestId, $logContent);
        $this->assertContains('testInfo', $logContent);
        $this->assertContains('[' . LogLevel::INFO . ']', $logContent);
    }

}