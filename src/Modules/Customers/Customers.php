<?php

namespace Vikuraa\Modules\Customers;

use Vikuraa\Core\Collection;

class Customers extends Collection
{
    public function __construct()
    {
        parent::__construct(Customer::class);
    }

    public function addAll(array $items) : void
    {
        foreach ($items as $customer) {
            $this->add($customer);
        }
    }

    public function addFromDbArray(array $row) : void
    {
        $this->add(Customer::fromDbArray($row));
    }

    public function addAllFromDbArray(array $data) : void
    {
        foreach ($data as $row) {
            $this->addFromDbArray($row);
        }
    }
}