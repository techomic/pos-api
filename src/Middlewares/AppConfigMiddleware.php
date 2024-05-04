<?php

namespace Vikuraa\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vikuraa\Modules\AppConfig\AppConfigs;
use Vikuraa\Modules\AppConfig\AppConfigModel;

class AppConfigMiddleware
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function __invoke(Request $request, RequestHandler $handler)
    {
        try {
            $model = new AppConfigModel($this->container);
            $appConfigs = $model->all();
            $this->container->set(AppConfigs::class, $appConfigs);
            return $handler->handle($request);
        } catch (\Exception $e) {
            $response = $handler->handle($request);

            return $response->withJson(['message' => $e->getMessage()], 401);
        }
    }
}