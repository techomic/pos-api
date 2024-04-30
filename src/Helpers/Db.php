<?php

namespace Vikuraa\Helpers;

use PDO;
use PDOException;
use Vikuraa\Exceptions\ConnectionException;
use Psr\Log\LoggerInterface;
use Vikuraa\Exceptions\DatabaseException;
use Exception;

class Db
{
    protected $container;
    protected $host;
    protected $port;
    protected $sslmode;
    protected $name;
    protected $user;
    protected $password;
    protected $pdo;
    protected $stmt;
    protected $logger;

    public function __construct($container, $user, $password)
    {
        $this->container = $container;
        $this->host = $this->container->get('settings')['db']['host'];
        $this->port = $this->container->get('settings')['db']['port'];
        $this->sslmode = $this->container->get('settings')['db']['sslmode'];
        $this->name = $this->container->get('settings')['db']['name'];
        $this->user = $user;
        $this->password = $password;
        $this->logger = $this->container->get(LoggerInterface::class);

        $dsn = 'pgsql:host=' . $this->host
        . ';port=' . $this->port
        . ';dbname=' . $this->name 
        . ';user=' . $this->user 
        . ';password=' . $this->password 
        . ';sslmode=' . $this->sslmode 
        . ';';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, null, null, $options);
        } catch (PDOException $e) {
            throw new ConnectionException('Database connection failed', $e->getCode(), $e);
        }
    }

    public function connected(): bool
    {
        return $this->pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) !== null;
    }

    public function query(string $query, array $params = [])
    {
        try {
            if (count($params) > 0) {
                $this->stmt = $this->pdo->prepare($query);
                $this->stmt->execute($params);
                return $this->stmt->fetchAll();
            }
            
            $this->stmt = $this->pdo->query($query);
            return $this->stmt->fetchAll();
        } catch (PDOException $e) {
            throw new DatabaseException('Database query failed: ' . $e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function execute(string $query, array $params = [], bool $needInsertId = false): mixed
    {
        try {
            if (count($params) === 0) {
                $result = $this->pdo->exec($query);
            }
            $this->stmt = $this->pdo->prepare($query);
            $result = $this->stmt->execute($params);

            if (strpos(strtoupper($query), 'INSERT') === 0 && $needInsertId) {
                return $this->pdo->lastInsertId();
            }

            return $result;
        } catch (PDOException $e) {
            throw new DatabaseException('Database query failed: ' . $e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            throw $e;
        }
    }
}