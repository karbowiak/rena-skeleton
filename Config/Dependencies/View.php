<?php

$container["view"] = function($container) {
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("Config");
    $config = $config->getAll("settings");
    
    $view = new \Slim\Views\Twig($config["view"]["templatePath"], $config["view"]["twig"]);

    $view->addExtension(new \Slim\Views\TwigExtension($container->get("router"), $container->get("request")->getUri()));
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

return $container;