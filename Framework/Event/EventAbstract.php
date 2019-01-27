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
    public $whileObservers = [];
    
    public $beforeObservers = [];
    
    public $afterObservers = [];

    public function whileEvent(){}
    
    public function beforeEvent(){}
    
    public function afterEvent(){}
    
    public function addObserver(ObserverInterface $observer, $type){}
    
    public function delObserver(ObserverInterface $observer, $type){}
    
}
    