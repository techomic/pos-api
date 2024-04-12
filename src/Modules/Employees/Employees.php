<?php

namespace Vikuraa\Modules\Employees;

use Vikuraa\Core\Collection;

class Employees extends Collection
{
    public function add(Employee $employee): void
    {
        $this->items[] = $employee;
    }

    public function addAll(array $employees): void
    {
        foreach ($employees as $employee) {
            if (!$employee instanceof Employee) {
                throw new \InvalidArgumentException('Invalid employee');
            }
            $this->add($employee);
        }
    }

    public function addFromDbArray(array $data)
    {
        $employee = Employee::fromDbArray($data);
        $this->add($employee);
    }

    public function addAllFromDbArray(array $data)
    {
        foreach ($data as $employee) {
            $this->addFromDbArray($employee);
        }
    }
}