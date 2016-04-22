<?php

// Define the basedir
define("BASEDIR", __DIR__);

// Change to this dir
chdir(BASEDIR);

// Load the autoloader
if (file_exists(__DIR__ . "/vendor/autoload.php")) {
    /** @var Composer\Autoload\ClassLoader $loader */
    $loader = require_once __DIR__ . "/vendor/autoload.php";
} else {
    throw new Exception("vendor/autoload.php not found, make sure you run composer install");
}

// Require the Config
if (file_exists(__DIR__ . "/Config/Config.php")) {
    $config = require_once __DIR__ . "/Config/Config.php";
} else {
    throw new Exception("Config.php not found (you might wanna start by copying config_new.php)");
}

// Load the container
$container = new \Slim\Container();

// Load dependencies
foreach(glob(__DIR__ . "/Config/Dependencies/*.php") as $file)
    require_once($file);

// Global functions
// Dump and die!
function dd($input) {
    var_dump($input); die();
}