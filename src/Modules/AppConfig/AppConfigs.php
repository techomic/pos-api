<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Collection;

class AppConfigs extends Collection
{
    public function __construct()
    {
        parent::__construct(AppConfig::class);
    }

    public function getValue($key): mixed
    {
        $found = false;
        foreach ($this->items as $appConfig) {
            if ($appConfig->key === $key) {
                $found = true;
                return $appConfig->value;
            }
        }

        if (!$found) {
            return null;
        }
    }
}