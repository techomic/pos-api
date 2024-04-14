<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

require_once __DIR__ . '/../MigrationTrait.php';

final class CreateTableEmployees extends AbstractMigration
{
    use MigrationTrait;

    public function change(): void
    {
        $table = $this->table($this->tablePrefix . 'employees', ['id' => false, 'primary_key' => 'person_id']);
        $table->addColumn('person_id', 'integer', ['null' => false])
            ->addColumn('username', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('password', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('deleted', 'boolean', ['null' => false, 'default' => 0])
            ->addColumn('hash_version', 'smallinteger', ['null' => false, 'default' => 2])
            ->addColumn('language', 'string', ['limit' => 48, 'null' => true])
            ->addColumn('language_code', 'string', ['limit' => 8, 'null' => true])
            ->addIndex(['username'], ['unique' => true])
            ->addIndex(['person_id'])
            ->save();

        $sql = "grant select, insert, update on {$this->tablePrefix}employees to vikuraa_users";
        $this->execute($sql);
    }
}
