<?php

namespace Vikuraa\Exceptions;

use Exception;

class AuthException extends Exception
{
    public function __construct($message = null)
    {
        $this->message = 'You must authenticate to access this resource.';

        if ($message) {
            $this->message = $message;
        }
        
        $this->code = 401;
    }
}