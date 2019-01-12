<?php
/**
 * 
 * @author yumancang
 * 
 * */

 
namespace Twinkle\Library\Router;



class GeneralStrategy implements RouterStrategy
{   
    public function __construct()
    {
        
    }
    
    public function parseUrl()
    {
        
        $queryString = $_SERVER['QUERY_STRING'];
        $queryArrTemp = explode('&', $queryString);
        $queryArr = [];
        foreach ($queryArrTemp as $val) {
            list($paramName, $paramValue) = explode('=', $val);
            $queryArr[$paramName] = $paramValue;
        }
        
        $module = isset($queryArr['m']) && !empty($queryArr['m']) ? $queryArr['m'] : false;
        $action = isset($queryArr['a']) && !empty($queryArr['a']) ? $queryArr['a'] : false;
        unset($queryArr['m']);
        unset($queryArr['a']);
        return [$module, $action, $queryArr];
    }
    
    
}