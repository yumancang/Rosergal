<?php

/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

namespace App\Library\Common;

class Globals 
{
    public static function get($key)
    {
        
        try {
            $keyArr = explode('.', $key);
            $n = count($keyArr);
            if ($n == 1) {
                return $GLOBALS[$key];
            }
        
            if ($n == 2) {
                return $GLOBALS[$keyArr[0]][$keyArr[1]];
            }
        
            if ($n == 3) {
                return $GLOBALS[$keyArr[0]][$keyArr[1]][$keyArr[2]];
            }
        
            if ($n > 3) {
                throw new \Exception('全局变量只到3层!');
            }
        } catch (\Exception $e) {
            echo '全局变量只到3层';
            exit();
        }
        
       
    }

    public static function set($key, $value)
    {
        try {
            $keyArr = explode('.', $key);
            
            $n = count($keyArr);
            if ($n == 1) {
                $GLOBALS[$keyArr[0]] = $value;
            }
            
            if ($n == 2) {
                $GLOBALS[$keyArr[0]][$keyArr[1]] = $value;
            }
            
            if ($n == 3) {
                $GLOBALS[$keyArr[0]][$keyArr[1]][$keyArr[2]] = $value;
            }
            
            if ($n > 3) {
                throw new \Exception('全局变量只到3层!');
            }
            
            
        } catch (\Exception $e) {
            echo '全局变量只到3层';
            exit();
        }
        return true;

    }

}


