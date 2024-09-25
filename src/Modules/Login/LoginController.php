<?php

namespace Vikuraa\Modules\Login;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Helpers\Db;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Helpers\EncryptionInterface;
use OpenApi\Attributes as OA;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpBadRequestException;
use Vikuraa\Modules\Employees\EmployeeModel;
use Vikuraa\Modules\Grants\GrantModel;
use Vikuraa\Helpers\Functions;

class LoginController extends Controller
{
    public function login(Request $request, Response $response)
    {
        // Get the username and password from the request body
        $data = $request->getParsedBody();
        $username = $data['username'];
        $password = $data['password'];

        // Check if a database connection can be established using the username and password

        $db = new Db($this->container, $username, $password);


        if ($db->connected()) {

            $this->container->set(Db::class, $db);

            // generate a JWT token
            $jwt = $this->container->get(JWt::class);
            $encryption = $this->container->get(EncryptionInterface::class);
            $encryptedPassword = $encryption->encrypt($password);

            $employeeModel = new EmployeeModel($this->container);

            $employee = $employeeModel->byUsername($username);

            $grantModel = new GrantModel($this->container);

            $grants = $grantModel->byPersonId($employee->personId);

            $sessionData = [
                'password' => $encryptedPassword,
                'employee' => $employee->toArray(),
                'grants'   => $grants->toArrayDeep(),
            ];

            $this->cache->put("user_session:$username", $sessionData);

            $token = $jwt->create([
                'username' => $username,
                'password' => $encryptedPassword,
            ]);
            $expirationTime = time() + (15 * 60); // 15 minutes later
            return $response->withJson([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token,
                'expiresAt' => $expirationTime,
            ], 200);
        } else {
            throw new HttpForbiddenException($request, 'Invalid username or password');
        }
    }

    public function refreshToken(Request $request, Response $response)
    {
        $refreshToken = $request->getParsedBody()['refreshToken'];

        if (!isset($refreshToken) || $refreshToken == null) {
            return $response->withJson([
                'message' => 'Refresh token is required'
            ], 401);
            throw new HttpBadRequestException($request, 'Refresh token is required');
        }

        $jwtHelper = $this->container->get(Jwt::class);


        $createdAt = $jwtHelper->timestamp($refreshToken);

        $now = time();

        $elapsed = (int)(($now - $createdAt) / 60);

        if ($elapsed > 5) {
            throw new HttpForbiddenException($request, 'Refresh token expired. Please login again.');
        }


        $userData = $jwtHelper->getUserData($request);
        $username = $userData->payload->username;

        // get password from cache
        $password = json_decode($this->cache->get("user_session:{$username}"), true)['password'];

        $token = $jwtHelper->create([
            'username' => $username,
            'password' => $password,
        ]);

        $expirationTime = time() + (15 * 60); // 15 minutes later
        
        return $response->withJson([
            'status' => 'success',
            'message' => 'Refreshed token',
            'token' => $token,
            'expiresAt' => $expirationTime,
        ]);
    }

    // for testing only
    public function getRefreshToken(Request $request, Response $response)
    {
        $jwtHelper = $this->container->get(Jwt::class);

        return $response->withJson([
            'message' => 'Keep secret',
            'refreshToken' => $jwtHelper->create([
                'username' => 'admin',
                'timestamp' => time(),
            ])
        ]);
    }
}
