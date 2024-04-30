<?php

namespace Vikuraa\Core;

use DI\Container;
use Psr\Log\LoggerInterface;

abstract class Controller
{
    protected Container $container;
    protected LoggerInterface $logger;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if ($container->has(LoggerInterface::class)) {
            $this->logger = $container->get(LoggerInterface::class);
        }
    }
}