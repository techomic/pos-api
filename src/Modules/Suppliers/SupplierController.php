<?php

namespace Vikuraa\Modules\Suppliers;

use Slim\Exception\HttpBadRequestException;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Core\Controller;

class SupplierController extends Controller
{
    public function getById(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        if (empty($id)) {
            throw new HttpBadRequestException($request, 'ID of the supplier is required');
        }

        $model = new SupplierModel($this->container);

        return $response->withJson([
            'status' => 'success',
            'data' => $model->byId($id)->toArray()
        ]);
    }

    public function search(Request $request, Response $response)
    {
        $body = $request->getParsedBody();
    }
}