<?php
namespace App\Observer;

use Twinkle\Observer\ObserverAbstact;

/**
 * 观察者接口
 *
 * @author yumancang
 *
 * */
class PointObserver extends ObserverAbstact 
{
    
    public function __construct()
    {
        
    }
    
    
    public function process()
    {
        pre('送积分');
    }
}
