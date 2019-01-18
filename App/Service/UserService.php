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
        
        $this->cacheFacade->set('luolaifa','ffff');
        
        return $data;
    }

}
