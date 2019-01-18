<?php
namespace Twinkle\Library\Cache\Command;
use Twinkle\Library\Cache\Command\Command;

/**
 * set 命令
 *
 * @author yumancang
 *
 * */
class SetCommand extends Command
{   
    public function __construct($directive, array $params)
    {
        $this->directive = $directive;
        $this->params = $params;
        parent::__construct();
    }
    
    public function execute()
    {
        return $this->driver->{$this->directive}($this->params[0], $this->params[1], $this->params[2]);
    }
}
