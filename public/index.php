<?php
use Solaria\Framework\Core\Application;

/*
* Starting point, so dont fuck up herer!
*/


define("APP_PATH", realpath('..'));

//Debug stuff
error_reporting(E_ALL);
ini_set('display_errors', 1);

$_GET['_url'] = isset($_GET['_url']) ? $_GET['_url']: '/';

//composer!!!
require_once APP_PATH . '/vendor/autoload.php';

try {
    $app = new Application();
    $app->run();
} catch (Exception $e) {
    echo "Solaria-ERROR:<br />";
    echo $e->getMessage();
    echo "<br />";
    echo "<pre>";
    echo $e->getTraceAsString();
    echo "</pre>";
}
