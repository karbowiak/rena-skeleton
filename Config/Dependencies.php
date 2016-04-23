<?php

// Load the container
if(!isset($app))
    $container = new \Slim\Container();
else
    $container = $app->getContainer();

// Load dependencies
foreach(glob(__DIR__ . "/Dependencies/*.php") as $file)
    $container = require_once($file);

return $container;