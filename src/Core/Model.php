<?php

namespace Vikuraa\Core;

use DI\Container;
use Vikuraa\Helpers\Db;

abstract class Model
{
    protected Container $container;
    protected $db;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if ($container->has(Db::class)) {
            $this->db = $container->get(Db::class);
        }
    }
}