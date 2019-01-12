<?php
/**
 * 配置加载器
 * @author yumancang <laifaluo@126.com>
 *
 * */
namespace Twinkle\Config;


class ConfigLoader
{
    
    public static $Config;

    public static function LoadConfig($path, $filename)
    {
        $config = include $path . '/' . $filename;
        self::$Config[$filename] = $config;
    }
    

}

