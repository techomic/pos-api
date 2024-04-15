<?php

namespace Vikuraa\Exceptions;

use Exception;

class ConnectionException extends Exception
{
    public function __construct($message = 'Connection failed', $code = 401, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}