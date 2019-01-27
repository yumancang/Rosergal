<?php
namespace App\Observer;

use Twinkle\Observer\ObserverAbstact;

/**
 * 观察者接口
 *
 * @author yumancang
 *
 * */
class EmailObserver extends ObserverAbstact 
{
    
    public function __construct()
    {
        
    }
    
    
    public function process()
    {
        pre('发邮件');
    }
}
