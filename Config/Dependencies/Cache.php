<?php

$container["cache"] = function($container) {
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("config");
    return new \Rena\Lib\Cache($config);
};

return $container;