<?php

namespace Vikuraa\Exceptions;

use Exception;

class NoDataException extends Exception
{
    public function __construct($message = null)
    {
        $this->message = 'No data found.';

        if ($message) {
            $this->message = $message;
        }
        
        $this->code = 403;
    }
}