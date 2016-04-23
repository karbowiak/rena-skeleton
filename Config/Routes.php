<?php
// Define the App Path
define("APPPATH", BASEDIR . "/App");

$app->group("", function() use ($app) {
    $controller = new App\Controllers\IndexController($app);

    $app->get("/", $controller("index"));
});