<?php
namespace Twinkle\Observer;
/**
 * 观察者接口
 *
 * @author yumancang
 *
 * */
abstract class ObserverAbstact implements ObserverInterface
{
    protected $service;
    
    public function process(){}
}
