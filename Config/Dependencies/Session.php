<?php

$container["Session"] = function($container) {
    /** @var \Rena\Lib\Cache $cache */
    $cache = $container->get("Cache");
    return new \Rena\Lib\SessionHandler($cache);
};