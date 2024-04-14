<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

require_once __DIR__ . '/../MigrationTrait.php';

final class AddAdminEmployee extends AbstractMigration
{
    use MigrationTrait;

    public function up(): void
    {
        $sql = "create user admin with nocreatedb in group vikuraa_admins, vikuraa_users password 'changeme'";
        $this->execute($sql);

        $peopleTable = $this->table($this->tablePrefix . 'people');

        $data = [
            'person_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => null,
            'phone_number' => '555-555-5555',
            'email' => 'changeme@example.com',
            'address_1' => 'Address 1',
            'address_2' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'country' => '',
            'comments' => '',
        ];

        $peopleTable->insert($data)->save();

        $employeeTable = $this->table($this->tablePrefix . 'employees');

        $data = [
            'person_id' => 1,
            'username' => 'admin',
            'password' => password_hash('changeme', PASSWORD_DEFAULT),
            'deleted' => 0,
            'hash_version' => 2,
            'language' => null,
            'language_code' => null,
        ];

        $employeeTable->insert($data)->save();
    }

    public function down(): void
    {
        $this->execute('DELETE FROM ' . $this->tablePrefix . 'employees WHERE person_id = 1');
        $this->execute('DELETE FROM ' . $this->tablePrefix . 'people WHERE person_id = 1');
    }
}
