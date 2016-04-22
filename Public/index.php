<?php
// Help the built-in PHP server
if(PHP_SAPI == "cli-server") {
    $file = __DIR__ . $_SERVER["REQUEST_URI"];
    if(is_file($file))
        return false;
}

// Load App
require_once(__DIR__ . "/../App.php");

// Start the session
/** @var \Slim\Container $container */
$session = $container->get("Session");
session_set_save_handler($session, true);
session_cache_limiter(false);
session_start();

// Load Slim
$app = new \Slim\App($container);

// Load Routes
require_once(BASEDIR . "/Config/Routes.php");

// Start the app
$app->run();