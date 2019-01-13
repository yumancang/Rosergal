<?php
namespace Twinkle\Library\Service;

use Twinkle\Library\Service\ServiceLocatorTrait;
/**
 * 基础SERVICE层,控制层来调用这层
 * 这层必须调MODEL层---请遵守规则
 *
 * @author yumancang
 *
 * */
class Service
{
    
    use ServiceLocatorTrait;
    
    public static function supportAutoNamespaces() 
	{
        return [
            'App\\Model'
        ];
    }
    
    
    public function __construct()
    {

    }


}