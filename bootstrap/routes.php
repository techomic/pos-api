<?php

use Slim\Exception\HttpNotFoundException;
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

include __DIR__ . '/../src/Modules/AppConfig/routes.php';
include __DIR__ . '/../src/Modules/Customers/routes.php';
/**
 * Testing
 */
$route->get('/rounding-options', TestController::class . ':testRoundingOptions');
$route->get('/rounding-code-name', TestController::class . ':testGetRoundingCodeName');
$route->get('/rounding-round-number', TestController::class . ':testRoundNumber');
$route->get('/test-create-pdf', TestController::class . ':testCreatingPdf');
$route->get('/test-uri', TestController::class . ':testUri');
$route->get('/generate-random-bytes/{length}', TestController::class . ':generateRandomBytes');
$route->get('/encrypt/{string}', TestController::class . ':testEncryption');
$route->get('/test-hashing', TestController::class . ':testHashing');

$route->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});