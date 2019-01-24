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
     * @var File
     */
    protected $storage;

    protected function newLogger($useBuffer = false)
    {
        $this->storage = new File([
            'logPath' => ROOT_PATH . '/Runtime/logs',
            'logFile' => 'app.log',
            'useBuffer' => $useBuffer,
            'bufferSize' => 10,
            'rotate' => 'day',
        ]);
        return new Logger($this->storage);
    }

    public function testInfo()
    {
        $requestId = Request::singleton()->getRequestId();
        $logger = $this->newLogger();
        $logger->info('testInfo');
        $this->assertFileExists($this->storage->logFile);
        $logContent = file_get_contents($this->storage->logFile);
        $this->assertContains($requestId, $logContent);
        $this->assertContains('testInfo', $logContent);
        $this->assertContains('[' . LogLevel::INFO . ']', $logContent);
    }

    public function testUseBuffer()
    {
        $logger =  $this->newLogger(true);
    }

}