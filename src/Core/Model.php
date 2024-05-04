<?php

namespace Vikuraa\Core;

use DI\Container;
use Vikuraa\Helpers\Db;
use Vikuraa\Modules\AppConfig\AppConfigs;

abstract class Model
{
    protected Container $container;
    protected $db;
    protected $config;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if ($container->has(Db::class)) {
            $this->db = $container->get(Db::class);
        }

        if ($container->has(AppConfigs::class)) {
            $this->config = $this->container->get(AppConfigs::class);
        }
    }
}