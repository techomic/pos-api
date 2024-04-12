<?php

namespace Vikuraa\Modules\People;

use DateTime;
use Vikuraa\Core\Entity;

class Person extends Entity
{
    private int $personId;
    private string $firstName;
    private string $lastName;
    private ?string $gender;
    private string $phoneNumber;
    private string $email;
    private string $address1;
    private string $address2;
    private string $city;
    private string $state;
    private string $zip;
    private string $country;
    private string $comments;
    private DateTime $createdAt;

    

    public static function fromDbArray(array $data): self
    {
        $person = new self();
        $person->personId = $data['person_id'];
        $person->firstName = $data['first_name'];
        $person->lastName = $data['last_name'];
        $person->gender = $data['gender'];
        $person->phoneNumber = $data['phone_number'];
        $person->email = $data['email'];
        $person->address1 = $data['address_1'];
        $person->address2 = $data['address_2'];
        $person->city = $data['city'];
        $person->state = $data['state'];
        $person->zip = $data['zip'];
        $person->country = $data['country'];
        $person->comments = $data['comments'];
        $person->createdAt = $data['created_at'];
        return $person;
    }
}
