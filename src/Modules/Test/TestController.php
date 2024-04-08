<?php

namespace Vikuraa\Modules\Test;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Helpers\RoundingMode;
use Vikuraa\Helpers\DomPdfCreator;
class TestController extends Controller
{
    public function testRoundingOptions(Request $request, Response $response)
    {
        $roundingModes = $this->container->get(RoundingMode::class)->getRoundingOptions();
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => $roundingModes,
        ]);
    }

    public function testGetRoundingCodeName(Request $request, Response $response)
    {
        $roundingModes = $this->container->get(RoundingMode::class);
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => $roundingModes->getRoundingCodeName(1),
        ]);
    }

    public function testRoundNumber(Request $request, Response $response)
    {
        $rounded = $this->container->get(RoundingMode::class)->roundNumber(6, 10.5, 3);
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => $rounded,
        ]);
    }

    public function testCreatingPdf(Request $request, Response $response)
    {
        $html = '<h1>Hello World</h1>';
        $fileName = 'test';
        $pdf = $this->container->get(DomPdfCreator::class)->createPdf($html, $fileName);
    }

    public function testUri(Request $request, Response $response)
    {
        $uri = $this->container->get('request')->getUri();
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => $uri,
        ]);
    }
}