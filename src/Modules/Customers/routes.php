<?php

use Slim\Routing\RouteCollectorProxy;
use Vikuraa\Modules\Customers\CustomerController;

$route->group('/customer', function (RouteCollectorProxy $route) {
    $route->get('/by-id/{customerId}', CustomerController::class . ':byId');
    $route->post('/search', CustomerController::class . ':search');
});