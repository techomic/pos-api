<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableSales extends AbstractMigration
{
    // TODO: add foreign key to customer_id
    // TODO: add foreign key to employee_id
    // TODO: add foreign key to dinner_table_id
    public function up(): void
    {
        $this->table('sales')
            ->addColumn('sale_time', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('customer_id', 'integer')
            ->addColumn('employee_id', 'integer', ['null' => false])
            ->addColumn('comment', 'text')
            ->addColumn('invoice_number', 'string', ['limit' => 32])
            ->addColumn('quote_number', 'string', ['limit' => 32])
            ->addColumn('sale_status', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('dinner_table_id', 'integer')
            ->addColumn('work_order_number', 'string', ['limit' => 32])
            ->addColumn('sale_type', 'smallint', ['null' => false, 'default' => 0])
            ->addIndex(['invoice_number'], ['name' => 'invoice_number', 'unique' => true])
            ->addIndex(['customer_id'], ['name' => 'customer_id'])
            ->addIndex(['employee_id'], ['name' => 'employee_id'])
            ->addIndex(['sale_time'], ['name' => 'sale_time'])
            ->addIndex(['dinner_table_id'], ['name' => 'dinner_table_id'])
            ->save();
        
        $sql = "grant select, insert, update, delete on sales to vikuraa_users";
        $this->execute($sql);
    }

    public function down(): void
    {
        $this->table('sales')->drop()->save();
    }
}
