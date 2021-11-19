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
    public function should_not_create_fraction_with_invalid_input(string $invalidArguments)
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
    public function foo(string $validFraction, int $numerator, int $denominator)
    {
        $this->assertEquals($numerator, Fraction::fractionFromString($validFraction)->numerator());
        $this->assertEquals($denominator, Fraction::fractionFromString($validFraction)->denominator());
    }

}
