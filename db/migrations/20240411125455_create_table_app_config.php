<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

require_once __DIR__ . '/MigrationTrait.php';

final class CreateTableAppConfig extends AbstractMigration
{
    use MigrationTrait;
    
    public function change(): void
    {
        $table = $this->table($this->tablePrefix . 'app_config', ['id' => false, 'primary_key' => 'key']);
        $table->addColumn('key', 'string', ['limit' => 50])
            ->addColumn('value', 'string', ['limit' => 500, 'null' => false])
            ->create();
    }
}
