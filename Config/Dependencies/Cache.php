<?php

$container["Cache"] = function($container) {
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("Config");
    return new \Rena\Lib\Cache($config);
};

return $container;