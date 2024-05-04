<?php

namespace Vikuraa\Core;

use DateTime;
use Exception;

abstract class Entity
{
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }

        throw new Exception("Property $key does not exist");
    }

    public function __set($key, $value)
    {
        if (in_array($key, ['cratedAt', 'date'])) {
            $this->createdAt = new DateTime($value);
            return;
        }

        if (property_exists($this, $key)) {
            $this->$key = $value;
            return;
        }

        throw new Exception("Property $key does not exist");
    }

    public static function fromArray(array $data): static
    {
        $entity = new self();
        foreach ($data as $key => $value) {
            $entity->$key = $value;
        }

        return $entity;
    }

    abstract public static function fromDbArray(array $data): static;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}