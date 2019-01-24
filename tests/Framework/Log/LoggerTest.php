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

class LoggerTest extends TestCase
{

    public function testInfo()
    {
        Rosegal::$app->getLogger()->info('test');
    }

}