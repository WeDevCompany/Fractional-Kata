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
    private const DENOMINATOR_INDEX = 1;
    private const FRACTION_FIRST_INDEX_OF = 0;
    private int $numerator;
    private int $denominator;

    private function __construct(int $numerator, int $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }

    public static function fractionFromString(string $fraction): self
    {
        self::throwExceptionIfInvalidFraction($fraction);
        $matches = [];
        preg_match(self::FRACTION_ELEMENTS, $fraction, $matches);
        $numerator = self::cleanNumber($matches[self::FRACTION_FIRST_INDEX_OF], self::NUMERATOR_INDEX);
        $denominator = self::cleanNumber($matches[self::FRACTION_FIRST_INDEX_OF], self::DENOMINATOR_INDEX);
        return new self($numerator, $denominator);
    }

    private static function throwExceptionIfInvalidFraction(string $fraction)
    {
        if (empty($fraction) || !preg_match(self::VALID_FRACTION_FORMAT ,$fraction)) {
            throw new InvalidArgumentException('The Fraction has to be valid');
        }
    }

    private static function cleanNumber(string $fraction, int $fractionIndex): int
    {
        $fractionNumber = explode(self::FRACTION_SEPARATOR, $fraction);
        return (int) $fractionNumber[$fractionIndex];
    }

    public function numerator(): int
    {
        return $this->numerator;
    }

    public function denominator(): int
    {
        return $this->denominator;
    }

}
