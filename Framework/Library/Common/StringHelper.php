<?php

/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

namespace Twinkle\Library\Common;

class StringHelper
{

    /**
     * 字符串以指定字符结尾？
     *
     * 区分大小写
     *
     * @param string $string 原始字符串
     * @param string|array $ends 结尾的字符串，如果是一个**array**，表示只要以其中任意一个结尾即成立
     * @return bool
     */
    public function endWith($string, $ends)
    {
        foreach ((array) $ends as $item) {
            if ($item == substr($string, -strlen($item))) {
                return true;
            }
        }
        return false;
    }

}


