<?php

$container["render"] = function($container) {
    $view = $container->get("view");
    return new \Rena\Lib\Render($container->get("view"));
};

return $container;