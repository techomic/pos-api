<?php

namespace Vikuraa\Modules\Test;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TestController extends Controller
{
    public function testRoundingOptions(Request $request, Response $response)
    {
        $roundingModes = $this->container->get('helpers')['RoundingMode']['getRoundingOptions'];
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => $roundingModes,
        ]);
    }

    public function testGetRoundingCodeName(Request $request, Response $response)
    {
        $roundingModes = $this->container->get('helpers')['RoundingMode']['getRoundingCodeName'](1);
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => $roundingModes,
        ]);
    }
}