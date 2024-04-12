<?php

namespace Vikuraa\Modules\Employees;

use DateTime;
use Vikuraa\Modules\People\Person;

class Employee extends Person
{
    private string $username;
    private string $password;
    private bool $deleted;
    private int $hashVersion;
    private ?string $language;
    private ?string $languageCode;
    

    public static function fromDbArray(array $data): self
    {
        parent::fromDbArray($data);
        
        $employee = new self();

        $employee->username = $data['username'];
        $employee->password = $data['password'];
        $employee->deleted = $data['deleted'];
        $employee->hashVersion = $data['hash_version'];
        $employee->language = $data['language'];
        $employee->languageCode = $data['language_code'];

        return $employee;
    }
}