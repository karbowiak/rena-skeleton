<?php

// Change to this dir
chdir(__DIR__);

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

// Global functions
// Dump and die!
function dd($input) {
    var_dump($input); die();
}