<?php

namespace Vikuraa\Modules\Login;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Helpers\Db;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Helpers\EncryptionInterface;
use OpenApi\Attributes as OA;
use Vikuraa\Modules\Employees\EmployeeModel;
use Vikuraa\Modules\Grants\GrantModel;
use Vikuraa\Helpers\Functions;

class LoginController extends Controller
{
    #[OA\PathItem(
        path: "/user/login",
        post: new OA\Post(
            summary: "User login",
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(property: "username", type: "string"),
                            new OA\Property(property: "password", type: "string")
                        ]
                    ),
                    example: "{\"username\": \"admin\", \"password\": \"S3cureP@ssword\"}"
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful response",
                    content: new OA\MediaType(
                        mediaType: "application/json",
                        schema: new OA\Schema(
                            properties: [
                                new OA\Property(property: "message", type: "string"),
                                new OA\Property(property: "token", type: "string")
                            ]
                        ),
                        example: "{\"message\": \"Login successful\", \"token\": \"eysljdlf04rds0sdflwea0.ljsldfjasd0ljlksdjf.ljasdf00980\"}"
                    )
                ),
                new OA\Response(
                    response: 401,
                    description: "Error response",
                    content: new OA\MediaType(
                        mediaType: "application/json",
                        schema: new OA\Schema(
                            properties: [
                                new OA\Property(property: "message", type: "string")
                            ]
                        ),
                        example: "{\"message\": \"Login failed\"}"
                    )
                )
            ]
        )
    )]
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
                return $response->withJson(['message' => 'Login successful', 'token' => $token], 200);
            } else {
                return $response->withJson(['message' => 'Login failed'], 401);
            }
        } catch (\Exception $e) {
            return $response->withJson(['message' => $e->getMessage()], 401);
        }
    }

    #[OA\PathItem(
        path: "/user/refresh",
        post: new OA\Post(
            summary: "Refresh token",
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(property: "refreshToken", type: "string")
                        ]
                    ),
                    example: '{"refreshToken": "slu04LjYUO88dsfdIYIttsr7sdhgjdJGJH"}'
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful response",
                    content: new OA\MediaType(
                        mediaType: "application/json",
                        schema: new OA\Schema(
                            properties: [
                                new OA\Property(property: "message", type: "string"),
                                new OA\Property(property: "token", type: "string")
                            ]
                        ),
                        example: '{"message": "Refreshed token", "token": "34RyXyVBUnbdMMHR30xUfOvqtWtscmAPdSIqBMe91Cmb6Duw8W2ZrdXUaW3RSA2a1Kj6rKoCmQ7us3En05jq3JgbM"}'
                    )
                ),
                new OA\Response(
                    response: 401,
                    description: "Error response",
                    content: new OA\MediaType(
                        mediaType: "application/json",
                        schema: new OA\Schema(
                            properties: [
                                new OA\Property(property: "message", type: "string")
                            ]
                        ),
                        example: '{"message": "Token refresh failed"}'
                    )
                )
            ]
        )
    )]
    public function refreshToken(Request $request, Response $response)
    {
        $refreshToken = $request->getParsedBody()['refreshToken'];

        if (!isset($refreshToken) || $refreshToken == null) {
            return $response->withJson([
                'message' => 'Refresh token is required'
            ], 401);
        }

        try {
            $jwtHelper = $this->container->get(Jwt::class);

            
            $createdAt = $jwtHelper->timestamp($refreshToken);

            $now = time();

            $elapsed = (int)(($now - $createdAt) / 60);

            if ($elapsed > 5) {
                return $response->withJson([
                    'message' => 'Refresh token expired. Please login again.'
                ], 401);
            }

        
            $userData = $jwtHelper->getUserData($request);
            $username = $userData->payload->username;

            // get password from cache
            $password = json_decode($this->cache->get("user_session:{$username}"), true)['password'];

            $token = $jwtHelper->create([
                'username' => $username,
                'password' => $password,
            ]);

            return $response->withJson([
                'message' => 'Refreshed token',
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            $method = __METHOD__;
            $exception = Functions::exceptionMessage($e, $this->logger, $method);
            
            return $response->withJson(['message' => $exception['message'], 'code' => $exception['code']], $exception['code']);
        }
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