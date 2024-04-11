<?php

namespace Vikuraa\Core;

use DI\Container;

abstract class Model
{
    protected Container $container;
    protected $db;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if ($container->has('db')) {
            $this->db = $container->get('db');
        }
    }
}