<?php

// use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\Routing\RouteCollectorProxy;
use Vikuraa\Middlewares\JwtMiddleware;
use Vikuraa\Middlewares\DbMiddleware;
use Vikuraa\Middlewares\AppConfigMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Handlers\HttpErrorHandler;

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables from.env file
try {
    Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();
} catch (InvalidPathException $e) {
    // TODO: Need to log the error here
}

// Load the constants
require __DIR__ . '/constants.php';

// Create the container before creating the $app instance.
$containerBuilder = new ContainerBuilder();

// inject the settings into the DI container.
$settings = require __DIR__ . '/settings.php';
$settings($containerBuilder);

// Inject the dependencies into the DI container.
$dependencies = require __DIR__ . '/dependencies.php';
$dependencies($containerBuilder);

$container = $containerBuilder->build();


$debugMode = $container->get('settings')['app']['debug'];

$app = AppFactory::createFromContainer($container);

$logger = $container->get(LoggerInterface::class);

$unsafeExceptions = [];
$errorHandler = new HttpErrorHandler($app->getCallableResolver(), $app->getResponseFactory(), $logger);
$errorHandler->setUnsafeExceptions($unsafeExceptions);
$errorMiddleware = $app->addErrorMiddleware(boolval($debugMode), true, true, $logger);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->options('/{routes:.*}', function (Request $request, Response $response) {
    // CORS Pre-Flight OPTIONS Request Handler
    return $response;
});

// Login routes
$app->group('/user', function (RouteCollectorProxy $route) {
    include __DIR__ . '/../src/Modules/Login/routes.php';
});

// Register all the routes.
$app->group('', function (RouteCollectorProxy $route) {
    include __DIR__ . '/routes.php';
})
->add(new AppConfigMiddleware($container))
->add(new DbMiddleware($container))
->add(new JwtMiddleware($container))
;
