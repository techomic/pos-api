<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Attributes as OA;
use Vikuraa\Helpers\Functions;

class AppConfigController extends Controller
{
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