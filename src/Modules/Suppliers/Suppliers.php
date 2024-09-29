<?php

namespace Vikuraa\Modules\Suppliers;

use Vikuraa\Core\Collection;

class Suppliers extends Collection
{
    public function __construct()
    {
        parent::__construct(Supplier::class);
    }

    // add array of objects
    public function addAll(array $items) : void
    {
        foreach ($items as $supplier) {
            $this->add($supplier);
        }
    }

    // add one row from db
    public function addFromDbArray(array $row) : void
    {
        $this->add(Supplier::fromDbArray($row));
    }

    // add multiple rows from db
    public function addAllFromDbArray(array $data) : void
    {
        foreach ($data as $row) {
            $this->addFromDbArray($row);
        }
    }
}