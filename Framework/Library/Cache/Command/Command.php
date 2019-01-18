<?php
namespace Twinkle\Library\Cache\Command;
use Twinkle\Library\Cache\Command\CommandInterface;
use Twinkle\Library\Framework\Container;
use Twinkle\Library\Config\ConfigLoader;

/**
 * 缓存接口
 *
 * @author yumancang
 *
 * */
class Command implements CommandInterface
{
    public $driver;
    
    public $directive;
    
    public $params;
    
    public function __construct()
    {
        $cachePath = 'Twinkle\Library\Cache\Driver\\';
        $cacheClassPath = $cachePath . ucfirst(ConfigLoader::$Config['cache.php']['driver']);
        $params = ConfigLoader::$Config['cache.php'][ConfigLoader::$Config['cache.php']['driver']];
        
        
        $this->driver = Container::getInstance()->reflectorDebug($cacheClassPath, 
            [$params]);
        
        
    }
    
    public function execute()
    {
        
    }
}
