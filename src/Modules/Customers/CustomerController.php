<?php

namespace Vikuraa\Modules\Customers;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Attributes as OA;
use Slim\Exception\HttpBadRequestException;
use Vikuraa\Helpers\Functions;

class CustomerController extends Controller
{
    public function byId(Request $request, Response $response, array $args)
    {
        $customerId = $args['customerId'];
        if ($customerId == null || !is_int(intval($customerId))) {
            throw new HttpBadRequestException($request, 'Customer ID is required and should be integer');
        }

        $model = new CustomerModel($this->container);

        $customer = $model->byId($customerId);

        return $response->withJson([
            'status' => 'success',
            'data' => $customer->toArray(),
        ]);
    }

    public function search(Request $request, Response $response)
    {
        $body= $request->getParsedBody();

        $query = $body['query'] ?? null;
        $limit = $body['limit'] ?? 0;
        $offset = $body['offset'] ?? 0;
        $sort = $body['sort'] ?? 'first_name';
        $order = $body['order'] ?? 'asc';

        if ($query == null) {
            return $response->withJson([
                'status' => 'error',
                'message' => 'Query is required'
            ], 400);
        }

        try {
            $model = new CustomerModel($this->container);

            $data = $model->search($query, $limit, $offset, $sort, $order);

            return $response->withJson([
                'status' => 'success',
                'data' => $data->toArrayDeep()
            ]);
        } catch (\Exception $e) {
            $method = __METHOD__;
            $exception = Functions::exceptionMessage($e, $this->logger, $method);
            
            return $response->withJson(['status' => 'error', 'message' => $exception['message']], $exception['code']);
        }
    }
}