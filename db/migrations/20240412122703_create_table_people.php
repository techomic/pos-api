<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

require_once __DIR__ . '/../MigrationTrait.php';


final class CreateTablePeople extends AbstractMigration
{
    use MigrationTrait;

    public function change(): void
    {
        $table = $this->table($this->tablePrefix . 'people', ['id' => false, 'primary_key' => 'person_id']);
        $table->addColumn('person_id', 'integer', ['identity' => true])
            ->addColumn('first_name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('last_name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('gender', 'integer', ['null' => true, 'limit' => 1])
            ->addColumn('phone_number', 'string', ['limit' => 20, 'null' => false])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('address_1', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('address_2', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('city', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('state', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('zip', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('country', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('comments', 'text', ['null' => false])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['email'], ['unique' => true])
            ->save();
        
            $sql = "grant select, insert, update on {$this->tablePrefix}people to vikuraa_users";
            $this->execute($sql);
    }
}
