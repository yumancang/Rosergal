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
        $this->cacheFacade->set('name', 'yumancang', 100);
        $luolaifa = $this->cacheFacade->get('name');
        $luolaifa = $this->cacheFacade->hset('goods','1','one');
        $luolaifa = $this->cacheFacade->hget('goods','1');
        prend($luolaifa);
        return $data;
    }

}
