<?php
//网站启动
function pre($arr)
{
    $data = func_get_args();
    foreach ($data as $key => $val) {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
}

function prend()
{
    $data = func_get_args();
    foreach ($data as $key => $val) {
        echo '<pre>';
        var_dump($val);
        echo '</pre>';
    }
    exit();
}

define('ROOT_PATH', __DIR__);

require_once 'vendor/autoload.php';

App\Rosegal::Bootstrap();


