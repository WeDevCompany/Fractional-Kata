<?php

declare(strict_types=1);

namespace Fractional;

use InvalidArgumentException;

class Fractional
{
    private const VALID_FRACTION_FORMAT = '/{[0-9]+\/[0-9]+}/m';

    public static function fractionFromString(string $fraction)
    {
        self::throwExceptionIfInvalidFraction($fraction);
    }

    private static function throwExceptionIfInvalidFraction(string $fraction)
    {
        if (empty($fraction) || !preg_match(self::VALID_FRACTION_FORMAT ,$fraction)) {
            throw new InvalidArgumentException('The Fraction has to be valid');
        }
    }
}
