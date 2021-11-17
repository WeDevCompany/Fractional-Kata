<?php

declare(strict_types=1);

namespace Fractional;

use InvalidArgumentException;

class Fractional
{
    public static function fractionFromString(string $fraction)
    {
        if (empty($fraction) || $fraction === '{') {
            throw new InvalidArgumentException('The Fraction has to be valid');
        }
    }
}
