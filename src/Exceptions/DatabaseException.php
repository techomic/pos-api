<?php

namespace Vikuraa\Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function __construct(string $message, string $code)
    {
        $message = $message . ' ' . $code;
        $newCode = '';
        for ($i = 0; $i < strlen($code); $i++) {
            if (is_int($code[$i])) {
                $newCode .= $code[$i];
            }
        }
        parent::__construct($message, (int)$code);
    }
}