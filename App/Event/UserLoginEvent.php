<?php
namespace App\Event;
use Twinkle\Observer\ObserverInterface;
use Twinkle\Event\EventAbstract;

/**
 * 用户登录事件接口
 *
 * @author yumancang
 *
 * */
class UserLoginEvent extends EventAbstract
{
    const EVENT_NAME = 'USER_LOGIN_EVENT';
    
    public function __construct()
    {
        
    }
    
    public function whileEvent()
    {
        foreach ($this->whileObservers as $key => $obj) {
            $obj->process();
        }
    }
    
    public function beforeEvent()
    {
        foreach ($this->beforeObservers as $key => $obj) {
            $obj->process();
        }
    }
    
    public function afterEvent()
    {
        foreach ($this->afterObservers as $key => $obj) {
            $obj->process();
        }
    }
    
    public function addObserver(ObserverInterface $observer, $type)
    {
        if ($type === self::WHILE_EVENT) {
            $this->whileObservers[get_class($observer)] = $observer;
        }
        if ($type === self::BEFORE_EVENT) {
            $this->beforeObservers[get_class($observer)] = $observer;
        }
        if ($type === self::AFTER_EVENT) {
            $this->afterObservers[get_class($observer)] = $observer;
        }
    }
    
    public function delObserver(ObserverInterface $observer, $type)
    {
        if ($type === self::WHILE_EVENT) {
            unset($this->whileObservers[get_class($observer)]);
        }
        if ($type === self::BEFORE_EVENT) {
            unset($this->beforeObservers[get_class($observer)]);
        }
        if ($type === self::AFTER_EVENT) {
            unset($this->afterObservers[get_class($observer)]);
        }
    }
}
