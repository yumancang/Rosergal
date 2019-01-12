<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2019/1/12
 * Time: 19:47
 */

namespace App\Component\Log;


use Twinkle\Log\Drivers\File;

class Elog extends File
{

    const APP_PLATFORM = "RG-PC";

    const METADATA_FILE = '/tmp/metadata_tags';//该文件有由运维人员控制
    const OMD_TMP_FILE = 'logs/elog/omd_tmp_file';
    const METADATA_URL = 'http://omd.glosop.com/index.php/Api/get_targetinfo?api_key=globalegrowZ2xvYmFsZWdyb3cK&target_key=name'; //该地址是固定的，不需要修改参数和值

    public static function getServerName()
    {
        $serverName = '';
        if (is_readable(self::METADATA_FILE)) {
            $metadataInfo = file_get_contents(self::METADATA_FILE);
        } elseif (is_readable(ROOT_PATH . self::OMD_TMP_FILE)) {
            $metadataInfo = file_get_contents(ROOT_PATH . self::OMD_TMP_FILE);
        } else {
            $metadataInfo = Curl::curlRequest(self::METADATA_URL);
            file_put_contents(ROOT_PATH . self::OMD_TMP_FILE, $metadataInfo);
        }

        if (!empty($metadataInfo)) {
            $metadataInfoList = explode(':', $metadataInfo);
            if (count($metadataInfoList) < 2) {
                $serverName = $metadataInfoList[0];
            } else {
                $serverName = $metadataInfoList[1];
            }
        }
        $serverName = strtolower($serverName);//确保所有标识为小写
        return trim($serverName);
    }

}