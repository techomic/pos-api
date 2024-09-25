<?php

namespace Vikuraa\Core;

use DI\Container;
use Psr\Log\LoggerInterface;
use OpenApi\Attributes as OA;
use Vikuraa\Helpers\Cache;
use Vikuraa\Modules\AppConfig\AppConfigs;

abstract class Controller
{
    protected Container $container;
    protected LoggerInterface $logger;
    protected $config;
    protected Cache $cache;
    protected $language;

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

        $this->language = $this->container->get('language');
    }
}