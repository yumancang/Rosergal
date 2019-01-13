<?php
namespace App\Controller;

use Twinkle\Library\Controller\Controller;
use App\Service\UserService;
/**
 * 只用来调度SERVICE逻辑
 * 
 * @author Administrator
 * @property UserService $userService
 *
 */
class UserController extends Controller
{
    
    public function index()
    {
        $res = $this->userService->getUserInfo();
        prend($res);
    }
    
    

}
