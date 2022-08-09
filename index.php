<?php
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(__FILE__));
require_once('config/config.php');
require_once('config/lib/helpers/helpers.php');
require __DIR__.'/vendor/autoload.php';
session_start();



$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

$db = DB::getInstance();

//Route the request
Router::route($url);

?>