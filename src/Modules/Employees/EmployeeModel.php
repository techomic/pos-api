<?php

namespace Vikuraa\Modules\Employees;

use Vikuraa\Core\Model;
use Vikuraa\Exceptions\NoDataException;
use Vikuraa\Helpers\EncryptionInterface;

class EmployeeModel extends Model
{

    public function listActive(): Employees
    {
        $sql = "SELECT * FROM employees WHERE deleted = 0";

        $data = $this->db->query($sql);

        $employees = new Employees();
        $employees->addAllFromDbArray($data);

        return $employees;
    }

    public function byUsername($username): Employee
    {
        $sql = "SELECT * FROM employee_person WHERE username = :username and deleted = false";

        $data = $this->db->query($sql, [':username' => $username]);

        if (!is_array($data) || count($data) === 0) {
            throw new NoDataException('Employee not found');
        }

        $employee = Employee::fromDbArray($data[0]);

        return $employee;
    }
}