<?php

$container["Db"] = function($container) {
    /** @var \Rena\Lib\Cache $cache */
    $cache = $container->get("Cache");
    /** @var \Monolog\Logger $logger */
    $logger = $container->get("Logger");
    /** @var \Rena\Lib\Timer $timer */
    $timer = $container->get("Logger");
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("Config");
    return new \Rena\Lib\Db($cache, $logger, $timer, $config);
};