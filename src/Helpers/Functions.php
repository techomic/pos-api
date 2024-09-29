<?php

namespace Vikuraa\Helpers;

use Psr\Log\LoggerInterface;
use Exception;

class Functions
{
    public static function offsetFromPage(int $limit, int $page): int
    {
        return ($page - 1) * $limit;
    }
}