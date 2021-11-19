<?php

declare(strict_types=1);

namespace Fraction;

use InvalidArgumentException;

class Fraction
{
    private const VALID_FRACTION_FORMAT = '/{[0-9]+\/[0-9]+}/m';
    private const FRACTION_ELEMENTS = '/(?:[1-9][0-9]*|0)(?:\/[1-9][0-9]*)?/';
    private const FRACTION_SEPARATOR = '/';
    private const NUMERATOR_INDEX = 0;
    private $numerator;

    private function __construct(int $numerator)
    {
        $this->numerator = $numerator;
    }

    public static function fractionFromString(string $fraction): self
    {
        self::throwExceptionIfInvalidFraction($fraction);
        $matches = [];
        preg_match(self::FRACTION_ELEMENTS, $fraction, $matches);
        $numerator = self::cleanNumerator($matches[0]);
        return new self($numerator);
    }

    private static function throwExceptionIfInvalidFraction(string $fraction)
    {
        if (empty($fraction) || !preg_match(self::VALID_FRACTION_FORMAT ,$fraction)) {
            throw new InvalidArgumentException('The Fraction has to be valid');
        }
    }

    private static function cleanNumerator(string $fraction): int
    {
        $numerator = explode(self::FRACTION_SEPARATOR, $fraction);
        return (int) $numerator[self::NUMERATOR_INDEX];
    }

    public function numerator(): int
    {
        return $this->numerator;
    }

}
