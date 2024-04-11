<?php

namespace Vikuraa\Middlewares;

use RuntimeException;
use Slim\Routing\RouteContext;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Exceptions\AuthException;

class JwtMiddleware
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $route = RouteContext::fromRequest($request)->getRoute();

        if (empty($route)) {
            throw new HttpNotFoundException($request);
        }

        try {
            $this->verifyToken($request);
        } catch (RuntimeException $exception) {

            $response = $handler->handle($request);

            // return $response->withJson([
            //     'code' => 50014,
            //     'message' => $exception->getMessage()
            // ], 200);
            $response->getBody()->write(json_encode([
                'code' => 50014,
                'message' => $exception->getMessage()
            ]));
            return $response->withHeader('Content-Type', 'application/json');
        }

        return $handler->handle($request);
    }

    private function verifyToken($request)
    {
        $jwtHelper = $this->container->get(Jwt::class);

        $token = $jwtHelper->getToken($request);

        if (empty($token)) {
            throw new AuthException();
        }

        try {
            return $jwtHelper->decode($token, 900); // 15 minutes
        } catch (RuntimeException $exception) {
            throw $exception;
        }
    }
}