<?php

$container["db"] = function($container) {
    /** @var \Rena\Lib\Cache $cache */
    $cache = $container->get("cache");
    /** @var \Monolog\Logger $logger */
    $logger = $container->get("logger");
    /** @var \Rena\Lib\Timer $timer */
    $timer = $container->get("timer");
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("config");
    /** @var \Psr\Http\Message\RequestInterface $request */
    $request = $container->get("request");

    return new \Rena\Lib\Db($cache, $logger, $timer, $config, $request);
};

return $container;