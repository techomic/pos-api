<?php

namespace Vikuraa\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Helpers\EncryptionInterface;
use Vikuraa\Helpers\Db;

class DbMiddleware
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $jwt = $this->container->get(Jwt::class);
        $userData = $jwt->getUserData($request);
        $encryption = $this->container->get(EncryptionInterface::class);

        $username = $userData->payload->username;
        $password = $encryption->decrypt($userData->payload->password);

        try {
            $db = new Db($this->container, $username, $password);

            if ($db->connected()) {
                $this->container->set(Db::class, $db);
                $handler->handle($request);
            } else {
                $response = $handler->handle($request);
                return $response->withJson(['message' => 'Database connection failed'], 401);
            }
        } catch (\Exception $e) {
            $response = $handler->handle($request);

            return $response->withJson(['message' => $e->getMessage()], 401);
        }
    }
}