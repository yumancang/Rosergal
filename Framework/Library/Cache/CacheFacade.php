<?php
namespace Twinkle\Library\Cache;
use Twinkle\Library\Framework\Container;

/**
 * 所有缓存入口
 * 
 * @author yumancang 
 *
 * */
class CacheFacade
{
    
    public function __construct()
    {
        
    }
    
    public function executeCommand(String $command, array $arguments)
    {
        $commandPath = 'Twinkle\Library\Cache\Command\\'.ucfirst($command).'Command';
        $command = Container::getInstance()->reflectorDebug($commandPath, [strtolower($command),$arguments]);
        return $command->execute();
        
    }
    
    public function __call(String $command, array $arguments)
    {
        return $this->executeCommand($command, $arguments);
    }

}
