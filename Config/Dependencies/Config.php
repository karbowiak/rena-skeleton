<?php

$container["Config"] = function($container) {
    return new \Rena\Lib\Config();
};

return $container;