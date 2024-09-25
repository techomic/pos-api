<?php

namespace Vikuraa\Middlewares;

use Slim\Http\ServerRequest as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Exceptions\AuthException;
use Slim\Psr7\Factory\StreamFactory;


class JwtMiddleware
{
    private Jwt $jwtHelper;

    public function __construct($container)
    {
        $this->jwtHelper = $container->get(Jwt::class);
    }

    public function __invoke(Request $request, RequestHandler $handler)
    {
        $token = $this->jwtHelper->getToken($request);

        if (empty($token)) {
            throw new AuthException('Token is required');
        }

        // check if the token has passed 10 minutes and send a refresh token
        $created = $this->jwtHelper->timestamp($token);
        $now = time();
        $elapsed = (int)(($now - $created) / 60);
        // var_dump($elapsed);
        if ($elapsed >= 10 && $elapsed < 15) {
            
            // create the refresh token
            $userData = $this->jwtHelper->getUserData($request);
            $username = $userData->payload->username;
            
            $tokenPayload = [
                'username' => $username,
                'timestamp' => time(),
            ];
            
            $response = $handler->handle($request);
            $data = json_decode($response->getBody()->getContents(), true);
            $data['refreshToken'] = $this->jwtHelper->create($tokenPayload);
            
            $streamFactory = new StreamFactory();

            return $response
                ->withBody($streamFactory->createStream(json_encode($data)))
                ->withHeader('Content-Type', 'application/json');
        }


        $tokenData = $this->jwtHelper->decode($token, 15 * 60); // 15 minutes
        
        $request = $request->withAttribute('tokenData', $tokenData);

        return $handler->handle($request);
    }
}
