<?php

// Keep at the top
$config = array();

// App
$config["app"] = array(
    "url" => "http://crunch.karbowiak.dk",
    "hash" => array(
        "algorithm" => PASSWORD_BCRYPT,
        "cost" => 15
    )
);

// Settings
$config["settings"] = array(
    "debug" => true,
    "whoops.editor" => "sublime",
    "displayErrorDetails" => true,
    "view" => array(
        "templatePath" => BASEDIR . "/App/Templates/",
        "twig" => array(
            "cache" => BASEDIR . "/Cache/Templates/",
            "debug" => true,
            "auto_reload" => true
        )
    ),
    "logger" => array(
        "name" => "App",
        "path" => BASEDIR . "/Logs/app.log"
    )
);

// Cache
$config["redis"] = array(
    "host" => "127.0.0.1",
    "port" => 6379
);

// Database
$config["database"] = array(
    "unixSocket" => "/var/run/mysqld/mysqld.sock",
    "host" => null,
    "port" => null,
    "username" => null,
    "password" => null,
    "emulatePrepares" => true,
    "useBufferedQuery" => true
);

// Keep at the bottom
return $config;