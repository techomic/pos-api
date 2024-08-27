<?php

namespace Vikuraa\Modules\Customers;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Attributes as OA;
use Vikuraa\Helpers\Functions;

class CustomerController extends Controller
{
    #[OA\PathItem(
        path: '/customer/by-id/{customerId}',
        get: new OA\Get(
            summary: 'Get customer information by ID',
            parameters: [
                new OA\Parameter(name: "customerId", required: true, content: [new OA\MediaType(mediaType: "int")])
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
                                    new OA\Property(property: 'personId', type: 'int'),
                                    new OA\Property(property: 'firstName', type: 'string'),
                                    new OA\Property(property: 'lastName', type: 'string'),
                                    new OA\Property(property: 'gender', type: 'int'),
                                    new OA\Property(property: 'phoneNumber', type: 'string'),
                                    new OA\Property(property: 'email', type: 'string'),
                                    new OA\Property(property: 'address1', type: 'string'),
                                    new OA\Property(property: 'address2', type: 'string'),
                                    new OA\Property(property: 'city', type: 'string'),
                                    new OA\Property(property: 'state', type: 'string'),
                                    new OA\Property(property: 'zip', type: 'string'),
                                    new OA\Property(property: 'country', type: 'string'),
                                    new OA\Property(property: 'comments', type: 'string'),
                                    new OA\Property(property: 'createdAt', type: 'object', properties: [
                                        new OA\Property(property: 'date', type: 'string'),
                                        new OA\Property(property: 'timezone_type', type: 'int'),
                                        new OA\Property(property: 'timezone', type: 'string')
                                    ]),
                                    new OA\Property(property: 'companyName', type: 'string'),
                                    new OA\Property(property: 'accountNumber', type: 'string'),
                                    new OA\Property(property: 'taxable', type: 'bool'),
                                    new OA\Property(property: 'taxId', type: 'string'),
                                    new OA\Property(property: 'salesTaxCodeId', type: 'int'),
                                    new OA\Property(property: 'discount', type: 'double'),
                                    new OA\Property(property: 'discountType', type: 'int'),
                                    new OA\Property(property: 'packageId', type: 'int'),
                                    new OA\Property(property: 'points', type: 'int'),
                                    new OA\Property(property: 'deleted', type: 'bool'),
                                    new OA\Property(property: 'date', type: 'date'),
                                    new OA\Property(property: 'employeeId', type: 'int'),
                                    new OA\Property(property: 'consent', type: 'bool'),
                                ])
                            ]
                        )
                    )
                )
            ]
        )
    )]
    public function byId(Request $request, Response $response, array $args)
    {
        $customerId = $args['customerId'];
        if ($customerId == null || !is_int($customerId)) {
            return $response->withJson([
                'status' => 'error',
                'message' => 'Customer ID is required and should be integer'
            ], 400);
        }

        try {
            $model = new CustomerModel($this->container);

            $customer = $model->byId($customerId);

            return $response->withJson([
                'status' => 'success',
                'data' => $customer->toArray(),
            ]);
        } catch (\Exception $e) {
            $method = __METHOD__;
            $exception = Functions::exceptionMessage($e, $this->logger, $method);
            
            return $response->withJson(['status' => 'error', 'message' => $exception['message']], $exception['code']);
        }
    }

    #[OA\PathItem(
        path: '/customer/search',
        post: new OA\Post(
            summary: 'Search customers',
            parameters: [
                new OA\Parameter(name: "query", required: true, content: [new OA\MediaType(mediaType: "string")]),
                new OA\Parameter(name: "limit", required: false, content: [new OA\MediaType(mediaType: "int")]),
                new OA\Parameter(name: "offset", required: false, content: [new OA\MediaType(mediaType: "int")]),
                new OA\Parameter(name: "sort", required: false, content: [new OA\MediaType(mediaType: "string")]),
                new OA\Parameter(name: "order", required: false, content: [new OA\MediaType(mediaType: "string")])
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
                                new OA\Property(property: "data", type: "array", items: new OA\Items(properties: [
                                        new OA\Property(property: 'personId', type: 'int'),
                                        new OA\Property(property: 'firstName', type: 'string'),
                                        new OA\Property(property: 'lastName', type: 'string'),
                                        new OA\Property(property: 'gender', type: 'int'),
                                        new OA\Property(property: 'phoneNumber', type: 'string'),
                                        new OA\Property(property: 'email', type: 'string'),
                                        new OA\Property(property: 'address1', type: 'string'),
                                        new OA\Property(property: 'address2', type: 'string'),
                                        new OA\Property(property: 'city', type: 'string'),
                                        new OA\Property(property: 'state', type: 'string'),
                                        new OA\Property(property: 'zip', type: 'string'),
                                        new OA\Property(property: 'country', type: 'string'),
                                        new OA\Property(property: 'comments', type: 'string'),
                                        new OA\Property(property: 'createdAt', type: 'object', properties: [
                                            new OA\Property(property: 'date', type: 'string'),
                                            new OA\Property(property: 'timezone_type', type: 'int'),
                                            new OA\Property(property: 'timezone', type: 'string')
                                        ]),
                                        new OA\Property(property: 'companyName', type: 'string'),
                                        new OA\Property(property: 'accountNumber', type: 'string'),
                                        new OA\Property(property: 'taxable', type: 'bool'),
                                        new OA\Property(property: 'taxId', type: 'string'),
                                        new OA\Property(property: 'salesTaxCodeId', type: 'int'),
                                        new OA\Property(property: 'discount', type: 'double'),
                                        new OA\Property(property: 'discountType', type: 'int'),
                                        new OA\Property(property: 'packageId', type: 'int'),
                                        new OA\Property(property: 'points', type: 'int'),
                                        new OA\Property(property: 'deleted', type: 'bool'),
                                        new OA\Property(property: 'date', type: 'date'),
                                        new OA\Property(property: 'employeeId', type: 'int'),
                                        new OA\Property(property: 'consent', type: 'bool'),
                                    ])
                                )
                            ]
                        )
                    )
                )
            ]
        )
    )]
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