<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2019/1/23
 * Time: 21:41
 */

namespace Twinkle\Log;


use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use Twinkle\Log\Drivers\File;

class LoggerTest extends TestCase
{
    /**
     * @var File
     */
    protected $storage;

    protected function newLogger($useBuffer = false,$rotate = 'day')
    {
        $this->storage = new File([
            'logPath' => './Runtime/logs',
            'logFile' => 'app.log',
            'useBuffer' => $useBuffer,
            'bufferSize' => 10,
            'rotate' => $rotate,
        ]);
        if (file_exists($this->storage->logFile)) {
            unlink($this->storage->logFile);
        }
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
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $logger->debug('testDebug', [
            'trace' => $trace
        ]);
        $logContent = file_get_contents($this->storage->logFile);
        $this->assertContains('[' . LogLevel::DEBUG . ']', $logContent);
    }

    public function testUseBuffer()
    {
        $logger = $this->newLogger(true,File::ROTATE_HOUR);

        $logList = [
            'emergency',
            'alert',
            'critical',
            'error',
            'warning',
            'notice',
            'info',
            'debug',
        ];

        foreach ($logList as $level) {
            $logger->{$level}($level);
        }
        unset($logger);
        $this->assertFileExists($this->storage->logFile);
        $rh = fopen($this->storage->logFile,'r');
        $count = 0;
        while ($row = fgets($rh)) {
            $this->assertContains('[' . $logList[$count] . ']', $row);
            $count++;
        }
        $this->assertEquals(8,$count);
    }

}