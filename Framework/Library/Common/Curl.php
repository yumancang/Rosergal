<?php

/**
 * CURL操作类
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

namespace Twinkle\Library\Common;



class Curl 
{
    /**
     * 获取远程接口数据
     * @param string $url 请求地址
     * @param array $header 头部信息
     * @param array $data 请求参数
     * @return mixed 响应结果
     */
    public static function curlRequest($url = '',$header = [],$data = [])
    {
        $ssl = substr($url, 0, 8) == "https://" ? true : false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        if ( $ssl ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}


