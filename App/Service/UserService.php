<?php
namespace App\Service;
use Twinkle\Library\Service\Service;
use App\Model\UserModel;

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

}
