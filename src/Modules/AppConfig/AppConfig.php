<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Entity;

class AppConfig extends Entity
{
    protected string $key;
    protected string $value;

    /**
     * Crate a new AppConfig instance from an array of data from the database.
     * 
     * @param array $data
     * @return AppConfig
     */
    public static function fromDbArray(array $data): static
    {
        $appConfig = new static();
        $appConfig->key = $data['key'];
        $appConfig->value = $data['value'];
        return $appConfig;
    }
}