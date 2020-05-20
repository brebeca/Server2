<?php
spl_autoload_register('spl_autoload', false);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define('ROOT', dirname( __DIR__ ) . DIRECTORY_SEPARATOR ) ;
require_once ROOT. 'core' . DIRECTORY_SEPARATOR ."DBConnection.php";
require_once ROOT. 'core' . DIRECTORY_SEPARATOR ."Main.php";
require_once ROOT. 'core' . DIRECTORY_SEPARATOR ."DBManagement.php";
require_once ROOT. 'public' . DIRECTORY_SEPARATOR ."config.php";
require_once 'vendor/autoload.php';


define('POSTS', ROOT . 'core' .DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR);
define('GETS', ROOT . 'core' .DIRECTORY_SEPARATOR . 'get' . DIRECTORY_SEPARATOR);


$modules=[ROOT, POSTS, GETS];

set_include_path(get_include_path().PATH_SEPARATOR.implode(PATH_SEPARATOR, $modules));

new Main();









