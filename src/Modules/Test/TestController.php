<?php

namespace Vikuraa\Modules\Test;

use Vikuraa\Core\Controller;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vikuraa\Helpers\RoundingMode;
use Vikuraa\Helpers\DomPdfCreator;
use Vikuraa\Helpers\EncryptionInterface;

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

    public function generateRandomBytes(Request $request, Response $response, $args)
    {
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => base64_encode(random_bytes($args['length'])),
        ]);
    }

    public function testEncryption(Request $request, Response $response, array $args)
    {
        $encryption = $this->container->get(EncryptionInterface::class);
        $encrypted = $encryption->encrypt($args['string']);
        $decrypted = $encryption->decrypt($encrypted);
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' =>  ['encrypted' => $encrypted, 'decrypted' => $decrypted],
        ]);
    }

    public function testHashing(Request $request, Response $response)
    {
        $encryption = $this->container->get(EncryptionInterface::class);
        $hash = $encryption->hash('password');
        $verify = $encryption->verify('password', $hash);
        return $response->withJson([
            'code' => 200,
            'message' => 'Success',
            'data' => ['hash' => $hash, 'verify' => $verify],
        ]);
    }
}