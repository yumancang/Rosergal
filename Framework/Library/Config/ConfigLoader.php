<?php
/**
 * 配置加载器
 * @author yumancang <laifaluo@126.com>
 *
 * */
namespace Twinkle\Library\Config;


class ConfigLoader
{

    public static $Config;

    public static function LoadConfig($path, $filename)
    {
        if (file_exists($realFile = $path . '/' . $filename)) {
            $config = include $realFile;
            return self::$Config[$filename] = $config;
        }
        return false;
    }


}

