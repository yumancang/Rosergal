<?php
namespace Twinkle\Event;
use Twinkle\Observer\ObserverInterface;

/**
 * 事件接口
 *
 * @author yumancang
 *
 * */
abstract class EventAbstract implements EventInterface
{
    const BEFORE_EVENT = 0;
    
    const WHILE_EVENT = 1;
    
    const AFTER_EVENT = 2;
    
    public $whileObservers = [];
    
    public $beforeObservers = [];
    
    public $afterObservers = [];

    public function whileEvent(){}
    
    public function beforeEvent(){}
    
    public function afterEvent(){}
    
    public function addObserver(ObserverInterface $observer, $type){}
    
    public function delObserver(ObserverInterface $observer, $type){}
    
}
    