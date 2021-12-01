<?php

declare(strict_types=1);

namespace Fraction;

use InvalidArgumentException;

class Fraction
{
    private const VALID_FRACTION_FORMAT = '/^{-?[0-9]+\/-?[0-9]+}$/m';
    private const FRACTION_ELEMENTS = '/(?:-?[1-9][0-9]*|0)(?:\/-?[1-9][0-9]*)?/m';
    private const FRACTION_SEPARATOR = '/';
    private const NUMERATOR_INDEX = 0;
    private const DENOMINATOR_INDEX = 1;
    private const FRACTION_FIRST_INDEX_OF = 0;
    private const INVALID_ZERO_VALUE = 0;
    private const NUMBER_ELEMENTS_OF_FRACTIONS = 2;
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
        self::throwExceptionIfBothNegativeOrZero($numerator, $denominator);
        return new self($numerator, $denominator);
    }

    /**
     * @parameter $fractionList List<Fraction>
     */
    public static function sume(...$fractionList): self
    {
        $summation = array_reduce($fractionList, fn($acumulate, $currentFraction) => $acumulate += $currentFraction->resolve());
        return self::fractionFromFloat($summation);
    }

    /**
     * https://stackoverflow.com/questions/14330713/converting-float-decimal-to-fraction
     */
    private static function fractionFromFloat(float $n): self {
        $tolerance = 1.e-6;
        $h1=1; $h2=0;
        $k1=0; $k2=1;
        $b = 1/$n;
        do {
            $b = 1/$b;
            $a = floor($b);
            $aux = $h1; $h1 = $a*$h1+$h2; $h2 = $aux;
            $aux = $k1; $k1 = $a*$k1+$k2; $k2 = $aux;
            $b = $b-$a;
        } while (abs($n-$h1/$k1) > $n*$tolerance );

        return new self((int) $h1,(int) $k1);
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
        self::throwExceptionIfNotTwoNumbers($fractionNumber);
        return (int) $fractionNumber[$fractionIndex];
    }

    private static function throwExceptionIfBothNegativeOrZero(int $numerator, int $denominator): void
    {
        if (self::areBothNegativeNumbers($numerator, $denominator) || self::isAnyNumberZero($numerator, $denominator)) {
            throw new InvalidArgumentException('Both numerator and denominator can not be negative');
        }
    }

    private static function areBothNegativeNumbers(int $numerator, int $denominator): bool
    {
        return $numerator < self::INVALID_ZERO_VALUE && $denominator < self::INVALID_ZERO_VALUE;
    }

    private static function isAnyNumberZero(int $numerator, int $denominator): bool
    {
        return $numerator === self::INVALID_ZERO_VALUE || $denominator === self::INVALID_ZERO_VALUE;
    }

    private static function throwExceptionIfNotTwoNumbers($fractionNumber): void
    {
        if (count($fractionNumber) !== self::NUMBER_ELEMENTS_OF_FRACTIONS) {
            throw new InvalidArgumentException('The Fraction has to be valid');
        }
    }

    public function numerator(): int
    {
        return $this->numerator;
    }

    public function denominator(): int
    {
        return $this->denominator;
    }

    public function __toString(): string
    {
        return sprintf('{%d/%d}', $this->numerator, $this->denominator);
    }

    public function resolve(): float
    {
        return $this->numerator / $this->denominator;
    }

}
