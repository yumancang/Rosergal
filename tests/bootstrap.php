<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2019/1/12
 * Time: 14:26
 */

define('ROOT_PATH', dirname(__DIR__));

define('TK_ENV','phpunit');

error_reporting(E_ALL);
$autoLoader = __DIR__ . '/../vendor/autoload.php';
if (! file_exists($autoLoader)) {
    echo "Composer autoloader not found: $autoLoader" . PHP_EOL;
    echo "Please issue 'composer install' and try again." . PHP_EOL;
    exit(1);
}
require $autoLoader;

\Twinkle\Library\Config\ConfigLoader::LoadConfig(ROOT_PATH . '/App/Config/' . TK_ENV, 'database.php');
\Twinkle\Library\Framework\Framework::simpleBoot();