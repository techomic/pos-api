<?php

namespace Vikuraa\Core;

use DI\Container;
use Psr\Log\LoggerInterface;
use OpenApi\Attributes as OA;
use Vikuraa\Helpers\Cache;
use Vikuraa\Modules\AppConfig\AppConfigs;

#[OA\Info(
    version: "1.0",
    title: "Vikuraa API",
    description: "POS Backend inspired by Opensource POS",
    contact: new OA\Contact(name: "Mohamed Usman", email: "emyu10@gmail.com")
)]
// #[OA\Server(
//     url: "https://example.localhost",
//     description: "API server"
// )]
abstract class Controller
{
    protected Container $container;
    protected LoggerInterface $logger;
    protected $config;
    protected Cache $cache;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if ($container->has(LoggerInterface::class)) {
            $this->logger = $container->get(LoggerInterface::class);
        }

        if ($container->has(AppConfigs::class)) {
            $this->config = $this->container->get(AppConfigs::class);
        }

        if ($container->has(Cache::class)) {
            $this->cache = $container->get(Cache::class);
        }
    }
}