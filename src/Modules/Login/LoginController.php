<?php

namespace Vikuraa\Modules\Login;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Helpers\Db;

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
                return $response->withJson(['message' => 'Login successful'], 200);
            }
        } catch (\Exception $e) {
            return $response->withJson(['message' => $e->getMessage()], 401);
        }
    }
}