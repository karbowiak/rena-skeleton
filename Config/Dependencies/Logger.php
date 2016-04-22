<?php

$container["Logger"] = function($container) {
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("Config");

    $logger = new \Monolog\Logger($config->get("name", "logger"));
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($config->get("path", "logger"), \Monolog\Logger::DEBUG));

    return $logger;
};