<?php

namespace Vikuraa\Helpers;

use Psr\Log\LoggerInterface;
use Exception;

class Functions
{
    public static function exceptionMessage(Exception $e, LoggerInterface $logger, ?string $method = null) : array
    {
        $exception = get_class($e);
        $message = $e->getMessage() . '. File: ' . $e->getFile() . ' on line ' . $e->getLine();
        $logger->error("{$method}|{$exception}: {$message}", $e->getTrace());
        $message = $e->getMessage();
        $code = $e->getCode();
        $firstLetter = ((string)$code)[0];
        if (!in_array((int)$firstLetter, [1, 2, 3, 4, 5])) {
            $code = 500;
            $message = 'Could not complete the operation';
        }

        return ['message' => $message, 'code' => $code];
    }
}