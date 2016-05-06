<?php

$container["session"] = function($container) {
    /** @var \Rena\Lib\Cache $cache */
    $cache = $container->get("cache");
    return new \Rena\Lib\SessionHandler($cache);
};

return $container;