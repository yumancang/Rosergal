<?php
namespace Twinkle\Library\Cache\Command;
use Twinkle\Library\Cache\Command\Command;

/**
 * set 命令
 *
 * @author yumancang
 *
 * */
class HsetCommand extends Command
{   
    public function __construct($directive, array $params)
    {
        $this->directive = $directive;
        $this->params = $params;
        parent::__construct();
    }
    
    public function execute()
    {
        return $this->driver->{$this->directive}($this->params[0], $this->params[1], 
        $this->params[2], isset($this->params[3]) ? $this->params[3] : 0);
    }
}
