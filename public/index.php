<?php

use Dotenv\Dotenv;
use Lib\Router;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../lib/Router.php";

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$config = require __DIR__ . "/../config/config.php";

foreach ($config["routes"] as $route) {
    $method = strtolower($route["method"]);

    Router::$method($route["path"], $route["action"]);
}

Router::dispatch();
