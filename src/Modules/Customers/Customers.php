<?php

namespace Vikuraa\Modules\Customers;

use Vikuraa\Core\Collection;

class Customers extends Collection
{
    public function __construct()
    {
        parent::__construct(Customer::class);
    }
}