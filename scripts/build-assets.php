<?php

require __DIR__ . "/../vendor/autoload.php";

use Lib\ScssCompiler;

$scss = new ScssCompiler();

$scssDir = __DIR__ . "/../public/assets/scss";
$cssDir = __DIR__ . "/../public/assets/css";

foreach (glob($scssDir . "/*.scss") as $file) {
    $name = basename($file, ".scss");
    $scss->compile($file, $cssDir . "/" . $name . ".css");
}

echo "Assets built\n";
