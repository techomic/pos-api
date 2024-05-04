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


$debugMode = getenv('APP_DEBUG') == null ? false : boolval(getenv('APP_DEBUG'));

AppFactory::setContainer($container);

$app = AppFactory::create();

$logger = $container->get(LoggerInterface::class);
$errorMiddleware = $app->addErrorMiddleware(boolval($debugMode), true, true, $logger);

// Login routes
$app->group('/user', function (RouteCollectorProxy $route) {
    include __DIR__ . '/../src/Modules/Login/routes.php';
    // $route->post('/login', 'Vikuraa\Modules\Login\LoginController:login');
});

// Register all the routes.
$app->group('', function (RouteCollectorProxy $route) {
    include __DIR__ . '/routes.php';
})
->add(new JwtMiddleware($container))
->add(new AppConfigMiddleware($container))
->add(new DbMiddleware($container));
