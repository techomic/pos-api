<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Entity;

class AppConfig extends Entity
{
    private string $key;
    private string $value;

    public static function fromDbArray(array $data): self
    {
        $appConfig = new self();
        $appConfig->key = $data['key'];
        $appConfig->value = $data['value'];
        return $appConfig;
    }
}