<?php
namespace Twinkle\Library\Cache\Command;
use Twinkle\Library\Cache\Command\Command;

/**
 * 缓存接口
 *
 * @author yumancang
 *
 * */
class SetCommand extends Command
{
    public $directive;
    
    public $params;
    
    public function __construct(string $directive, array $params)
    {
        $this->directive = $directive;
        $this->params = $params;
        
        parent::__construct();
        
    }
    
    public function execute()
    {
        #$reds->set(1,2);
        $this->driver->{$this->directive}($this->params[0], $this->params[1]);
    }
}
