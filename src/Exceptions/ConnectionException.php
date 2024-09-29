<?php

namespace Vikuraa\Exceptions;

use Exception;

class ConnectionException extends Exception
{
    public function __construct($message = 'Connection failed')
    {
        parent::__construct($message, 520);
    }
}