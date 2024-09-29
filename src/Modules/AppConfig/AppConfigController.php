<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Attributes as OA;
use Slim\Exception\HttpBadRequestException;
use Vikuraa\Helpers\Functions;

class AppConfigController extends Controller
{
    public function all(Request $request, Response $response)
    {
        $model = new AppConfigModel($this->container);
        return $response->withJson([
            'status' => 'success',
            'data' => $model->all()->toArrayDeep()
        ]);
    }

    public function byKey(Request $request, Response $response, array $args)
    {
        $model = new AppConfigModel($this->container);
        $key = $args['key'];
        return $response->withJson([
            'status' => 'success',
            'data' => $model->get($key)->toArray()
        ]);
    }

    public function save(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!isset($body['key']) || !isset($body['value'])) {
            throw new HttpBadRequestException($request, 'Key and value are required');
        }

        $model = new AppConfigModel($this->container);
        $model->save($body['key'], $body['value']);
        return $response->withJson(['status' => 'success']);
    }
}
