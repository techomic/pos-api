<?php

namespace Vikuraa\Modules\Attribute;

use Vikuraa\Core\Collection;

class AttributeDefinitions extends Collection
{
    public function __construct()
    {
        parent::__construct(AttributeDefinition::class);
    }

    // add array of objects
    public function addAll(array $items) : void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    // add one row from db
    public function addFromDbArray(array $row) : void
    {
        $this->add(AttributeDefinition::fromDbArray($row));
    }

    // add multiple rows from db
    public function addAllFromDbArray(array $data) : void
    {
        foreach ($data as $row) {
            $this->addFromDbArray($row);
        }
    }
}