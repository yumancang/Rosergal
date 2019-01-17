<?php
namespace Twinkle\Library\Cache\Command;
use Twinkle\Library\Cache\Command\CommandInterface;
use Twinkle\Library\Framework\Container;

/**
 * 缓存接口
 *
 * @author yumancang
 *
 * */
class Command implements CommandInterface
{
    public $driver;
    
    public function __construct()
    {
        $this->driver = Container::getInstance()->reflectorDebug('Twinkle\Library\Cache\Driver\\Predis');
        
    }
    
    public function execute()
    {
        
    }
}
