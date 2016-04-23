<?php

namespace Rena\Middleware;

use Slim\Container;

class RenaBootstrap
{
    public function __invoke($request, $response) {
        $container = require_once(__DIR__ . "/../../Config/Dependencies.php");
        $app = new \Slim\App($container);
        require(__DIR__ . "/../../Config/Routes.php");

        return $app($request, $response);
    }
}