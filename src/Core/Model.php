<?php

namespace Vikuraa\Core;

use DI\Container;
use Psr\Log\LoggerInterface;
use Vikuraa\Helpers\Db;
use Vikuraa\Modules\AppConfig\AppConfigs;
use Vikuraa\Helpers\Cache;

abstract class Model
{
    protected Container $container;
    protected $db;
    protected LoggerInterface $logger;
    protected $config;
    protected Cache $cache;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if ($container->has(Db::class)) {
            $this->db = $container->get(Db::class);
        }

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