<?php

use Slim\Routing\RouteCollectorProxy;
use Vikuraa\Modules\Suppliers\SupplierController;

$route->group('/supplier', function (RouteCollectorProxy $route) {
    $route->get('/by-id/{id}', SupplierController::class . ':getById');
});