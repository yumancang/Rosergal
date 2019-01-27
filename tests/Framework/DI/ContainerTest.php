<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2019/1/27
 * Time: 11:46
 */

namespace Twinkle\DI;


use PHPUnit\Framework\TestCase;
use Twinkle\DI\Exception\ContainerException;
use Twinkle\DI\Exception\NotFoundException;

class ContainerTest extends TestCase
{
    public function testInjection()
    {
        $definitions = [
            'test' => [
                'class' => HelloWorld::class,
            ]
        ];
        $container = new Container($definitions);
        $this->assertEquals(true,isset($container['test']));
        $container['test1'] = HelloWorld::class;
        $this->assertEquals(true,isset($container['test1']));
        $instance = $container['test1'];
        $this->assertInstanceOf(HelloWorld::class,$instance);
        unset($container['test1']);
        $this->assertEquals(false,isset($container['test1']));
        $this->expectException(ContainerException::class);
        $container->injection('classError',['param' => 'error']);
        $this->expectException(NotFoundException::class);
        $container->get('NotFound');
    }

}

class HelloWorld
{
    protected $params = [];

    public function __construct($params = [])
    {
        $this->params = $params;
    }

}