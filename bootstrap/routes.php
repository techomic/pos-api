<?php

/**
 * This is the main routes file for the application.
 * 
 * Include other routes files here.
 */

$route->get('/', function($request, $response) {
    $response->getBody()->write('Hello World!');

    return $response;
});