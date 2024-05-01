<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableAttributeValues extends AbstractMigration
{
    public function up(): void
    {
        $this->table('attribute_values')
            ->addColumn('value', 'string', ['limit' => 255])
            ->addColumn('date', 'date')
            ->addColumn('decimal', 'decimal', ['precision' => 7, 'scale' => 3])
            ->addIndex('value', ['unique' => true])
            ->addIndex('date', ['unique' => true])
            ->addIndex('decimal', ['unique' => true])
            ->save();
        
        $sql = "grant select, insert, update on attribute_values to vikuraa_users";
        $this->execute($sql);
    }

    public function down(): void
    {
        $this->table('attribute_values')->drop()->save();
    }
}
