<?php

use Vikuraa\Modules\Test\TestController;
/**
 * This is the main routes file for the application.
 * 
 * Include other routes files here.
 */

$route->get('/', function($request, $response) {
    $response->getBody()->write('Hello World!');

    return $response;
});

/**
 * Testing
 */
$route->get('/rounding-options', TestController::class . ':testRoundingOptions');
$route->get('/rounding-code-name', TestController::class . ':testGetRoundingCodeName');
$route->get('/rounding-round-number', TestController::class . ':testRoundNumber');
$route->get('/test-create-pdf', TestController::class . ':testCreatingPdf');
$route->get('/test-uri', TestController::class . ':testUri');
$route->get('/generate-random-bytes/{length}', TestController::class . ':generateRandomBytes');