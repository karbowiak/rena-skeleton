<?php

// Help the built-in PHP server
if(PHP_SAPI == "cli-server") {
    $file = __DIR__ . $_SERVER["REQUEST_URI"];
    if(is_file($file))
        return false;
}

// Start the session
//@TODO Replace with Session storage in Redis
session_start();

// Load App
require_once(__DIR__ . "/../App.php");

// Load Slim
$app = new \Slim\App($container);

// Load Routes
