<?php

$container["config"] = function($container) {
    return new \Rena\Lib\Config();
};

return $container;