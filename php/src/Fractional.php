<?php

declare(strict_types=1);

namespace Fractional;

use InvalidArgumentException;

class Fractional
{
    private const VALID_FRACTION_FORMAT = '/{[0-9]+\/[0-9]+}/m';
    private $numerator;

    private function __construct(int $numerator)
    {
        $this->numerator = $numerator;
    }

    public static function fractionFromString(string $fraction): self
    {
        self::throwExceptionIfInvalidFraction($fraction);
        $matches = [];
        preg_match('/(?:[1-9][0-9]*|0)(?:\/[1-9][0-9]*)?/', $fraction, $matches);
        $numerator = explode('/', $matches[0]);
        return new self((int) $numerator[0]);
    }

    private static function throwExceptionIfInvalidFraction(string $fraction)
    {
        if (empty($fraction) || !preg_match(self::VALID_FRACTION_FORMAT ,$fraction)) {
            throw new InvalidArgumentException('The Fraction has to be valid');
        }
    }

    private static function cleanNumerator(String $fraction)
    {

    }

    public function numerator(): int
    {
        return $this->numerator;
    }

}
