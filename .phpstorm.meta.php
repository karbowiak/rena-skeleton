<?php
/**
 * ProcessWire PhpStorm Meta
 *
 * This file is not a CODE, it makes no sense and won't run or validate
 * Its AST serves PhpStorm IDE as DATA source to make advanced type inference decisions.
 * 
 * @see https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
 */

namespace PHPSTORM_META {

    $STATIC_METHOD_TYPES = [
        new \Slim\Container => [
            '' == '@',
            'cache' instanceof Rena\Lib\Cache,
            'callableResolver' instanceof Slim\CallableResolver,
            'config' instanceof Rena\Lib\Config,
            'environment' instanceof Slim\Http\Environment,
            'errorHandler' instanceof Slim\Handlers\Error,
            'foundHandler' instanceof Slim\Handlers\Strategies\RequestResponse,
            'logger' instanceof Monolog\Logger,
            'notAllowedHandler' instanceof Slim\Handlers\NotAllowed,
            'notFoundHandler' instanceof Slim\Handlers\NotFound,
            'phpErrorHandler' instanceof Slim\Handlers\PhpError,
            'render' instanceof Rena\Lib\Render,
            'request' instanceof Slim\Http\Request,
            'response' instanceof Slim\Http\Response,
            'router' instanceof Slim\Router,
            'session' instanceof Rena\Lib\SessionHandler,
            'settings' instanceof Slim\Collection,
            'timer' instanceof Rena\Lib\Timer,
            'view' instanceof Slim\Views\Twig,
        ],
    ];

}
