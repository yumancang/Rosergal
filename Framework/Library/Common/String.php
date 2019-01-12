<?php

/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

namespace Twinkle\Library\Common;

class String 
{
    public static function addslashes ($str)
    {
        return addslashes($str);
    }
    
    public static function stripslashes($str)
    {
        return stripslashes($str);
    }
}


