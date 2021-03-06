<?php

namespace Fraction\Test;

use Fraction\Fraction;
use InvalidArgumentException;
use Iterator;
use PHPUnit\Framework\TestCase;

class FractionalTest extends TestCase
{
    /**
     * @test
     * @dataProvider createInvalidArguments
     */
    public function should_not_create_fraction_with_invalid_input(string $invalidArguments): void
    {
        $this->expectException(InvalidArgumentException::class);
        Fraction::fractionFromString($invalidArguments);
    }

    /**
     * @return iterator<string>
     */
    public function createInvalidArguments(): iterator
    {
        yield [''];
        yield ['{'];
        yield ['}'];
        yield ['{}'];
        yield ['({})'];
        yield ['({a/a})'];
        yield ['{a/a}'];
        yield ['{a3/a3}'];
        yield ['{3a/3a}'];
        yield ['{03/3a}'];
        yield ['{a3/03}'];
        yield ['{a3/0}'];
        yield ['{0/0a}'];
        yield ['{0/a0}'];
        yield ['{0/0}'];
        yield ['{0/3}'];
        yield ['{-3/0}'];
        yield ['{-1/-2}'];
        yield ['{-01/-02}'];
        yield [' { 1 / -2 }'];
        yield [' {1/-2} {1/-2} '];
        yield ['{1/-2}{1/-2}'];
        yield ['{1/-2} {1/-2}'];
        yield ['1/-2'];
        yield ['1/2'];
        yield ['12'];
        yield ['{1/-3-3}'];
        yield ['{-1-1/3}'];
    }

    /**
     * @return iterator<string>
     */
    public function createValidArguments(): iterator
    {
        yield ['{1/2}', 1, 2];
        yield ['{-1/2}', -1, 2];
        yield ['{1/-2}', 1, -2];
    }

    /**
     * @test
     * @dataProvider createValidArguments
     */
    public function should_create_fraction_with_valid_input(string $validFraction, int $numerator, int $denominator): void
    {
        $this->assertEquals($numerator, Fraction::fractionFromString($validFraction)->numerator());
        $this->assertEquals($denominator, Fraction::fractionFromString($validFraction)->denominator());
    }

     /**
      * @test
      */
    public function should_sum_two_fraction_with_same_denominator(): void
    {
        $fraction = Fraction::fractionFromString('{1/2}');
        $fraction2 = Fraction::fractionFromString('{3/2}');
        $output = Fraction::fractionFromString('{4/2}')->resolve();

        $this->assertSame($output, $fraction->sum($fraction2)->resolve());
    }

    /**
     * @test
     */
    public function should_sum_four_fraction_with_same_denominator(): void
    {
        $fraction = Fraction::fractionFromString('{1/2}');
        $fraction1 = Fraction::fractionFromString('{1/2}');
        $fraction2 = Fraction::fractionFromString('{3/2}');
        $fraction3 = Fraction::fractionFromString('{3/2}');
        $output = Fraction::fractionFromString('{8/2}')->resolve();

        $this->assertEquals($output, $fraction->sum($fraction1)->sum($fraction2)->sum($fraction3)->resolve());
    }

    /**
     * @test
     */
    public function should_sum_four_fraction_with_different_denominator(): void
    {
        $fraction = Fraction::fractionFromString('{2/3}');
        $fraction1 = Fraction::fractionFromString('{4/5}');
        $output = Fraction::fractionFromString('{22/15}')->resolve();

        $this->assertEquals($output, $fraction->sum($fraction1)->resolve());
    }

    /**
     * @test
     */
    public function should_subtract_four_fraction_with_different_denominator(): void
    {
        $fraction = Fraction::fractionFromString('{2/3}'); // 1/15
        $fraction1 = Fraction::fractionFromString('{4/5}');
        $output = Fraction::fractionFromString('{2/15}')->resolve();

        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->assertEquals($output, Fraction::subtract($fraction, $fraction1)->resolve());
    }

}
