<?php

namespace Vikuraa\Helpers;

use PDO;

class Db extends PDO
{
    protected $container;
    protected $host;
    protected $port;
    protected $sslmode;
    protected $name;
    protected $user;
    protected $password;

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
        . ';charset=utf8';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        parent::__construct($dsn, null, null, $options);
    }
}