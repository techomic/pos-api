<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

require_once __DIR__ . '/../MigrationTrait.php';

final class CreateViewEmployeePerson extends AbstractMigration
{
    use MigrationTrait;

    public function up(): void
    {
        $view = $this->execute("create view {$this->tablePrefix}employee_person as 
            select 
                p.*,
                e.username,
                e.password,
                e.deleted,
                e.hash_version,
                e.language,
                e.language_code
            from {$this->tablePrefix}employees e
            join {$this->tablePrefix}people p on e.person_id = p.person_id");
    }

    public function down(): void
    {
        $this->execute("DROP VIEW {$this->tablePrefix}employee_person");
    }
}
