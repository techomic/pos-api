<?php

namespace Vikuraa\Modules\Items;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ItemController extends Controller
{
    public function mainFilters(Request $request, Response $response)
    {
        
    }
    
    public function list(Request $request, Response $response)
    {
        
    }

    // public function search(Request $request, Response $response)
    // {
    //     $body = $request->getParsedBody();
    //     $search = $body['search'];
    //     $limit = $body['limit'] ?? 20;
    //     $page = $body['page'] ?? 1;
    //     $sort = $body['sort'];
    //     $order = $body['order'];

    //     $model = new ItemModel($this->container);

    //     $model->search();
    // }
}