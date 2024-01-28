<?php

namespace Techomic\Helpers;

class RoundingMode
{
    const HALF_UP = PHP_ROUND_HALF_UP;
    const HALF_DOWN = PHP_ROUND_HALF_DOWN;
    const HALF_EVEN = PHP_ROUND_HALF_EVEN;
    const HALF_ODD = PHP_ROUND_HALF_ODD;
    const ROUND_UP = 5;
    const ROUND_DOWN = 6;
    const HALF_FIVE = 7;

    public static function getRoundingModes()
    {
        
    }
}