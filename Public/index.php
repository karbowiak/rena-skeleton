<?php
// Help the built-in PHP server
if(PHP_SAPI == "cli-server") {
    $file = __DIR__ . $_SERVER["REQUEST_URI"];
    if(is_file($file))
        return false;
}

// Load Init
require_once(__DIR__ . "/../Init.php");

// Load Slim
$app = new \Slim\App($config);

// Load the container
require_once(__DIR__ . "/../Config/Dependencies.php");

// Start the session
/** @var \Slim\Container $container */
$session = $container->get("session");
session_set_save_handler($session, true);
session_cache_limiter(false);
session_start();

// Add Whoops
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

// Load Routes
require_once(__DIR__ . "/../Config/Routes.php");

// Start the app
$app->run();