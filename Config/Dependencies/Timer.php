<?php

$container["timer"] = function($container) {
    return new \Rena\Lib\Timer();
};

return $container;