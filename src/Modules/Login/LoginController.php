<?php

namespace Vikuraa\Modules\Login;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Helpers\Db;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Helpers\EncryptionInterface;

class LoginController extends Controller
{
    /**
     * Post login here.
     * 
     */
    public function login(Request $request, Response $response)
    {
        // Get the username and password from the request body
        $data = $request->getParsedBody();
        $username = $data['username'];
        $password = $data['password'];

        // Check if a database connection can be established using the username and password
        try {
            $db = new Db($this->container, $username, $password);

            if ($db->connected()) {
                // generate a JWT token
                $jwt = $this->container->get(JWt::class);
                $encryption = $this->container->get(EncryptionInterface::class);

                // TODO: get the session data and store in in-memory cache
                $token = $jwt->create([
                    'username' => $username,
                    'password' => $encryption->encrypt($password)
                ]);
                return $response->withJson(['message' => 'Login successful', 'token' => $token], 200);
            } else {
                return $response->withJson(['message' => 'Login failed'], 401);
            }
        } catch (\Exception $e) {
            return $response->withJson(['message' => $e->getMessage()], 401);
        }
    }
}