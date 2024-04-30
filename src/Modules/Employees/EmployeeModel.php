<?php

namespace Vikuraa\Modules\Employees;

use Vikuraa\Core\Model;
use DI\Container;
use Vikuraa\Helpers\EncryptionInterface;

class EmployeeModel extends Model
{
    private $tableName = '';
    private $viewName = '';

    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->tableName = 'employees';
        $this->viewName = 'employee_person';
    }

    public function listActive(): Employees
    {
        $sql = "SELECT * FROM {$this->viewName} WHERE deleted = 0";

        $data = $this->db->query($sql);

        $employees = new Employees();
        $employees->addAllFromDbArray($data);

        return $employees;
    }

    public function login($username, $password): Employee
    {
        $encryption = $this->container->get(EncryptionInterface::class);
        $hash = $encryption->hash($password);

        $sql = "SELECT * FROM {$this->viewName} WHERE username = :username and password = :password and deleted = 0";

        $data = $this->db->query($sql, [':username' => $username, ':password' => $hash]);

        if (!is_array($data) || count($data) === 0) {
            throw new \Exception('Invalid username or password');
        }
        
        $employee = Employee::fromDbArray($data);

        return $employee;
    }
}