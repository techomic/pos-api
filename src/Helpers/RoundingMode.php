<?php

namespace Vikuraa\Helpers;

use DI\Container;

class RoundingMode
{
    private Container $container;

    const HALF_UP = PHP_ROUND_HALF_UP;
    const HALF_DOWN = PHP_ROUND_HALF_DOWN;
    const HALF_EVEN = PHP_ROUND_HALF_EVEN;
    const HALF_ODD = PHP_ROUND_HALF_ODD;
    const ROUND_UP = 5;
    const ROUND_DOWN = 6;
    const HALF_FIVE = 7;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    public function getRoundingOptions()
    {
        $langLines = $this->container->get('language');
        $result = [];
        
        $class = new \ReflectionClass(__CLASS__);
        
        foreach ($class->getConstants() as $key => $value) {
            $result[$value] = $langLines[strtolower('ENUM_' . $key)];
        }

        return $result;
    }

    public function getRoundingCodeName($code)
    {
        $langLines = $this->container->get('language');
        
        if (empty($code)) {
            return $langLines['common_unknown'];
        }

        return $this->getRoundingOptions()[$code];
    }

    public function roundNumber($roundingMode, $amount, $decimals)
    {
        if ($roundingMode == self::ROUND_UP) {
            $fig = pow(10, $decimals);
            $roundedTotal = (ceil($fig * $amount) + ceil($fig * $amount - ceil($fig * $amount))) / $fig;
            return $roundedTotal;
        } elseif ($roundingMode == self::ROUND_DOWN) {
            $fig = pow(10, $decimals);
			$roundedTotal = (floor($fig * $amount) + floor($fig * $amount - floor($fig * $amount))) / $fig;
            return $roundedTotal;
        } elseif ($roundingMode == self::HALF_FIVE) {
            $roundedTotal = round($amount / 5, $decimals, self::HALF_EVEN) * 5;
            return $roundedTotal;
        } else {
            $roundedTotal = round($amount, $decimals, $roundingMode);
            return $roundedTotal;
        }
    }
}