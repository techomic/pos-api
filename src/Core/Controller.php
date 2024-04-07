<?php

namespace Vikuraa\Core;

use DI\Container;

abstract class Controller
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}