<?php

use Slim\Routing\RouteCollectorProxy;
use Vikuraa\Modules\AppConfig\AppConfigController;

$route->group('/app-config', function (RouteCollectorProxy $route) {
    $route->get('/all', AppConfigController::class . ':all');
    $route->get('/by-key/{key}', AppConfigController::class . ':byKey');
    $route->post('/save', AppConfigController::class . ':save');
});