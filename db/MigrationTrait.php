<?php

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

require __DIR__ . '/../vendor/autoload.php';



trait MigrationTrait
{
    protected ?string $dbName = null;

    public function init()
    {
        try {
            Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();
        } catch (InvalidPathException $e) {
            // TODO: Need to log the error here
        }

        $this->dbName = getenv('DB_NAME') ?? 'vikuraa';
    }
}