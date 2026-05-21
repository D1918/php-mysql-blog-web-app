<?php

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;

return [
    "app" => [
        "name" => "Blog App",
        "debug" => $_ENV["APP_MODE"],
    ],
    "db" => [
        "host" => $_ENV["DB_HOST"],
        "name" => $_ENV["DB_NAME"],
        "user" => $_ENV["DB_USER"],
        "pass" => $_ENV["DB_PASS"],
        "charset" => $_ENV["DB_CHARSET"],
    ],
    "routes" => [
        [
            "method" => "GET",
            "path" => "/",
            "action" => [HomeController::class, "index"],
        ],
        [
            "method" => "GET",
            "path" => "/category/{slug}",
            "action" => [CategoryController::class, "index"],
        ],
        [
            "method" => "GET",
            "path" => "/article/{slug}",
            "action" => [ArticleController::class, "index"],
        ],
    ],
];
