<?php

namespace Vikuraa\Helpers;

use DI\Container;
use Predis\Client;

class Cache
{
    private $client;

    public function __construct(Container $container)
    {
        $settings = $container->get('settings')['valkey'];

        $this->client = new Client([
            'scheme' => $settings['scheme'],
            'host'   => $settings['host'],
            'port'   => $settings['port'],
        ]);
    }

    public function put(string $key, mixed $val)
    {
        if (is_array($val)) {
            $val = json_encode($val);
        }

        return $this->client->executeRaw(['SET', $key, $val]);
    }

    public function get(string $key)
    {
        return $this->client->executeRaw(['GET', $key]);
    }

    public function delete(string $key)
    {
        return $this->client->executeRaw(['DEL', $key]);
    }
}