<?php

namespace Vikuraa\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vikuraa\Exceptions\ConnectionException;
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
        $userData = $request->getAttribute('tokenData');
        $encryption = $this->container->get(EncryptionInterface::class);
        
        $username = $userData->payload->username;
        $password = $encryption->decrypt($userData->payload->password);
        
        
        $db = new Db($this->container, $username, $password);
        
        if ($db->connected()) {
            $this->container->set(Db::class, $db);
            return $handler->handle($request);
        } else {
            throw new ConnectionException('Database connection failed');
        }
    }
}
