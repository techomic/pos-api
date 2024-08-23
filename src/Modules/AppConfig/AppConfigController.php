<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Attributes as OA;
use Vikuraa\Helpers\Functions;

class AppConfigController extends Controller
{
    #[OA\PathItem(
        path: '/app-config/all',
        get: new OA\Get(
            summary: 'Get all application configurations',
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful response",
                    content: new OA\MediaType(
                        mediaType: 'application/json',
                        schema: new OA\Schema(
                            properties: [
                                new OA\Property(property: "status", type: "string"),
                                new OA\Property(
                                    property: "data",
                                    type: "array",
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: "key", type: "string"),
                                            new OA\Property(property: "value", type: "string")
                                        ]    
                                    )
                                )
                            ]
                        )
                    )
                ),
                new OA\Response(
                    response: 500,
                    description: "Error response",
                    content: new OA\MediaType(
                        mediaType: "application/json",
                        schema: new OA\Schema(
                            properties: [
                                new OA\Property(property: "message", type: "string")
                            ]
                        )
                    )
                )
            ]
        )
    )]
    public function all(Request $request, Response $response)
    {
        try {
            $model = new AppConfigModel($this->container);
            return $response->withJson([
                'status' => 'success',
                'data' => $model->all()->toArrayDeep()
            ]);
        } catch (\Exception $e) {
            $method = __METHOD__;
            $exception = Functions::exceptionMessage($e, $this->logger, $method);
            
            return $response->withJson(['message' => $exception['message']], $exception['code']);
        }
    }

    #[OA\PathItem(
        path: '/app-config/by-key/{key}',
        get: new OA\Get(
            summary: 'Get application config by key',
            parameters: [
                new OA\Parameter(name: "key", required: true, content: [new OA\MediaType(mediaType: "string")])
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Success response',
                    content: new OA\MediaType(
                        mediaType: 'application/json',
                        schema: new OA\Schema(
                            properties: [
                                new OA\Property(property: "status", type: "string"),
                                new OA\Property(property: "data", type: "object", properties: [
                                    new OA\Property(property: "key", type: "string"),
                                    new OA\Property(property: "value", type: "string")
                                ])
                            ]
                        )
                    )
                )
            ]
        )
    )]
    public function byKey(Request $request, Response $response, array $args)
    {
        try {
            $model = new AppConfigModel($this->container);
            $key = $args['key'];
            return $response->withJson([
                'status' => 'success',
                'data' => $model->get($key)->toArray()
            ]);
        } catch (\Exception $e) {
            $method = __METHOD__;
            $exception = Functions::exceptionMessage($e, $this->logger, $method);
            
            return $response->withJson(['message' => $exception['message']], $exception['code']);
        }
    }

    public function save(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!isset($body['key']) || !isset($body['value'])) {
            return $response->withJson(['message' => 'Key and value are required'], 400);
        }

        try {
            $model = new AppConfigModel($this->container);
            $model->save($body['key'], $body['value']);
            return $response->withJson(['status' => 'success']);
        } catch (\Exception $e) {
            $method = __METHOD__;
            $exception = Functions::exceptionMessage($e, $this->logger, $method);
            
            return $response->withJson(['message' => $exception['message']], $exception['code']);
        }
    }
}