<?php
/**
 * 管道操作
 * @author yumancang <laifaluo@126.com>
 *
 * */
namespace Twinkle\Framework;

use InvalidArgumentException;

class Pipeline
{
    private $stages = [];
    
    public $passable;

    public function __construct()
    {
    }

    public function pipe($stage)
    {
        $this->stages[] = $stage;

        return $this;
    }



    public function process($cloure = null)
    {
        if (is_callable($cloure)) {
            $cloure();
        }
        
        foreach ($this->stages as $stage) {
            if (is_object($stage)) {
                call_user_func([$stage,'handler']);
            } elseif (is_callable($stage)) {
                $stage();
            }
        }
        
        
        return true;
    }

    public function __invoke()
    {
        return $this->process();
    }
}
