<?php

namespace Vikuraa\Helpers;

use PDO;

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

    public function __construct($container, $user, $password)
    {
        $this->container = $container;
        $this->host = $this->container->get('settings')['db']['host'];
        $this->port = $this->container->get('settings')['db']['port'];
        $this->sslmode = $this->container->get('settings')['db']['sslmode'];
        $this->name = $this->container->get('settings')['db']['name'];
        $this->user = $user;
        $this->password = $password;
        
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

        $this->pdo = new PDO($dsn, null, null, $options);
    }

    public function connected(): bool
    {
        return $this->pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) !== null;
    }

    public function query(string $query, array $params = [])
    {
        if (count($params) > 0) {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($params);
            return $this->stmt->fetchAll();
        }
        
        $this->stmt = $this->pdo->query($query);
        return $this->stmt->fetchAll();
    }
}