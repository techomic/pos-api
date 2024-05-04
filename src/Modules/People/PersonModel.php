<?php

namespace Vikuraa\Modules\People;

use Vikuraa\Core\Model;

class PersonModel extends Model
{
    public function save(Person $person)
    {
        $sql = "
            insert into people (
                first_name,
                last_name,
                gender,
                phone_number,
                email,
                address_1,
                address_2,
                city,
                state,
                zip,
                country,
                comments
            ) values (
                :first_name,
                :last_name,
                :gender,
                :phone_number,
                :email,
                :address_1,
                :address_2,
                :city,
                :state,
                :zip,
                :country,
                :comments
            ) 
        ";

        $args = [
            'first_name' => $person->firstName,
            'last_name' => $person->lastName,
            'gender' => $person->gender,
            'phone_number' => $person->phoneNumber,
            'email' => $person->email,
            'address_1' => $person->address1,
            'address_2' => $person->address2,
            'city' => $person->city,
            'state' => $person->state,
            'zip' => $person->zip,
            'country' => $person->country,
            'comments' => $person->comments,
        ];

        return $this->db->execute($sql, $args, true);
    }

    public function emailExists(string $email): bool
    {
        $sql = "select * from people where email = :email";
        $args = ['email' => $email];
        return $this->db->count($sql, $args) > 0;
    }
}