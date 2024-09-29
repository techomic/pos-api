<?php

namespace Vikuraa\Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function __construct(string $message, string $code)
    {
        $message = "[{$code}]: {$message}";

        parent::__construct($message, 520);
    }
}