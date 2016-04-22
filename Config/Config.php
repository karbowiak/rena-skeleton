<?php

// Keep at the top
$config = array();

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

// Logging
$config["logger"] = array(
    "name" => "rena.log",
    "path" => BASEDIR . "/Logs/"
);

// View / Twig
$config["view"] = array(
    "templatePath" => BASEDIR . "/App/Templates/",
    "twig" => array(
        "cache" => BASEDIR . "/Cache/Templates/",
        "debug" => true,
        "auto_reload" => true
    )
);

// Keep at the bottom
return $config;