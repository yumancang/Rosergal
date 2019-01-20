<?php

/**
 *工具函数
 *
 * @author yumancang
 *
 * */

namespace Twinkle\Library\Common;

class Helper
{

    /**
     * 字符转换
     *
     * @param $string
     * @param string $separator
     * @return mixed|string
     */
    public static function revertUcWords($string, $separator = '-')
    {
        static $revertUcWords = [];
        $key = $string . $separator;
    
        if (isset($revertUcWords[$key])) {
            return $revertUcWords[$key];
        } elseif (!ctype_lower($string)) {
            $string = preg_replace_callback(
                '/([A-Z])/',
                function ($matches) use ($separator) {
                    return $separator . strtolower($matches[0]);
                },
                $string
            );
            $string = trim($string, $separator);
        }
    
        return $revertUcWords[$key] = $string;
    }
    
    /**
     * 字符串以指定字符结尾？
     *
     * 区分大小写
     *
     * @param string $string 原始字符串
     * @param string|array $ends 结尾的字符串，如果是一个**array**，表示只要以其中任意一个结尾即成立
     * @return bool
     */
    public static function endWith($string, $ends)
    {
        foreach ((array)$ends as $item) {
            if ($item == substr($string, -strlen($item))) {
                return true;
            }
        }
        return false;
    }
}


