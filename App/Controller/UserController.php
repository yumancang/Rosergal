<?php
namespace App\Controller;

use Twinkle\Library\Controller\Controller;
use App\Service\UserService;
/**
 * 只用来调度SERVICE逻辑
 * 
 * @author Administrator
 *
 */
class UserController extends Controller
{
    protected $userService;
    
    public function __construct()
    {
        $this->userService = new UserService();
    }
    
    
    public function index()
    {
        $res = $this->userService->getUserInfo();
        prend($res);
    }
    
    

}
