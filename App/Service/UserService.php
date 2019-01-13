<?php
namespace App\Service;
use Twinkle\Library\Service\Service;
use App\Model\UserModel;

class UserService extends Service
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();

    }
    
    
    public function getUserInfo()
    {
        $data = $this->userModel->getUserInfo();
        #逻辑处理
        return $data;
    }

}
