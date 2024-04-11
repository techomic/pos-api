<?php

namespace Vikuraa\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class DbMiddleware
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function __invoke(Request $request, RequestHandler $handler)
    {
        // Perform any actions before the request is handled
        
        // Example: Connect to the database
        
        // Call the next middleware or the final request handler
        $response = $handler->handle($request);
        
        // Perform any actions after the request is handled
        
        // Example: Close the database connection
        
        return $response;
    }
}