<?php

// Load the container
$container = $app->getContainer();

// Load dependencies
foreach(glob(__DIR__ . "/Dependencies/*.php") as $file)
    require_once($file);