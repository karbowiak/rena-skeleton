<?php

$container["Twig"] = function($container) {
    /** @var \Rena\Lib\Config $config */
    $config = $container->get("Config");

    $view = new \Slim\Views\Twig($config->get("templatePath", "view"), $config->getAll("view")["twig"]);

    $view->addExtension(new \Slim\Views\TwigExtension($container->get("router"), $container->get("request")->getUri()));
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};