<?php
namespace App\Service;
use Twinkle\Library\Service\Service;
use App\Model\UserModel;
use App\Event\UserLoginEvent;
use App\Observer\EmailObserver;
use App\Observer\PointObserver;

class UserService extends Service
{

    public function getUserInfo()
    {
        //$data = $this->userModel->getUserInfo();
        #逻辑处理
        #credis
        /* $this->cacheFacade->set('name', 'yumancang');
        $luolaifa = $this->cacheFacade->get('name');
               //$luolaifa = $this->cacheFacade->delete('name');
        
        $luolaifa = $this->cacheFacade->hset('goods','1','one',100);
        $luolaifa = $this->cacheFacade->hget('goods','1'); 
        //$luolaifa = $this->cacheFacade->delete('goods');
        $luolaifa = $this->cacheFacade->ping();
        
        $luolaifa = $this->cacheFacade->expire('name', 100);
        prend($luolaifa); */
        
        #credis_replication
        $this->cacheFacade->set('name', 'yumancang');
        $luolaifa = $this->cacheFacade->get('name');
        $luolaifa = $this->cacheFacade->hset('goods','1','one',100);
        $luolaifa = $this->cacheFacade->hget('goods','1');
        //$luolaifa = $this->cacheFacade->delete('goods');
        $luolaifa = $this->cacheFacade->ping();

        prend($luolaifa);
        return $data;
    }
    
    
    public function login()
    {
        $userLoginEvent = new UserLoginEvent();
        $userLoginEvent->addObserver(new EmailObserver(),0);
        $userLoginEvent->addObserver(new PointObserver(),2);
        #风控验证
        $userLoginEvent->beforeEvent();
        
        #登录逻辑处理
        #insert into
        
        #日志记录，邮件处理，积分促销码赠送...
        $userLoginEvent->afterEvent();
    }

}
