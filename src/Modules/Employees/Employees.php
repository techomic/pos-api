<?php

namespace Vikuraa\Modules\Employees;

use Vikuraa\Core\Collection;

class Employees extends Collection
{
    public function __construct()
    {
        parent::__construct(Employee::class);
    }

    public function addAll(array $employees): void
    {
        foreach ($employees as $employee) {
            $this->add($employee);
        }
    }

    public function addFromDbArray(array $data) : void
    {
        $employee = Employee::fromDbArray($data);
        $this->add($employee);
    }

    public function addAllFromDbArray(array $data) : void
    {
        foreach ($data as $employee) {
            $this->addFromDbArray($employee);
        }
    }
}