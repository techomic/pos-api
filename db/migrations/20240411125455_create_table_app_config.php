<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

require_once __DIR__ . '/MigrationTrait.php';

final class CreateTableAppConfig extends AbstractMigration
{
    use MigrationTrait;
    
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table($this->tablePrefix . 'app_config');
        $table->addColumn('key', 'string', ['limit' => 50])
            ->addColumn('value', 'string', ['limit' => 500])
            ->create();
    }
}
