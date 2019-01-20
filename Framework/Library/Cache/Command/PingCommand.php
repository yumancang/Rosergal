<?php
namespace Twinkle\Library\Cache\Command;
use Twinkle\Library\Cache\Command\Command;

/**
 * ping 命令
 *
 * @author yumancang
 *
 * */
class PingCommand extends Command
{   
    public function __construct($directive, array $params)
    {
        $this->directive = $directive;
        $this->params = $params;
        parent::__construct();
    }
    
    public function execute()
    {
        return $this->driver->{$this->directive}();
    }
}
