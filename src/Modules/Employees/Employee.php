<?php

namespace Vikuraa\Modules\Employees;

use DateTime;
use Vikuraa\Modules\People\Person;

class Employee extends Person
{
    protected string $username;
    protected bool $deleted;
    protected int $hashVersion;
    protected ?string $language;
    protected ?string $languageCode;
    

    public static function fromDbArray(array $data): static
    {
        parent::fromDbArray($data);
        
        $employee = new static();

        $employee->username = $data['username'];
        $employee->deleted = $data['deleted'];
        $employee->hashVersion = $data['hash_version'];
        $employee->language = $data['language'];
        $employee->languageCode = $data['language_code'];

        return $employee;
    }
}