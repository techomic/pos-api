<?php

namespace Vikuraa\Modules\Login;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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

        // Get the employee model
        
    }
}