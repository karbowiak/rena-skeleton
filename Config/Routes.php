<?php
// Define the App Path
$app->group("", function() use ($app) {
    $controller = new App\Controllers\IndexController($app);
    $app->get("/", $controller("index"));
    $app->get("/json/", $controller("api"));
});