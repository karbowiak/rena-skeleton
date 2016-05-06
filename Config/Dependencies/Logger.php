<?php

$container["logger"] = function($container) {
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("config");
    $config = $config->getAll("settings");

    $logger = new \Monolog\Logger($config["logger"]["name"]);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($config["logger"]["path"], \Monolog\Logger::DEBUG));

    return $logger;
};

return $container;