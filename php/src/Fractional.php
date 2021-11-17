<?php

declare(strict_types=1);

namespace Fractional;

class Fractional
{
    public static function fractionFromString(string $fraction)
    {
        if (empty($fraction)) {
            throw new \InvalidArgumentException('The Fraction can not be empty');
        }
    }
}
