<?php

namespace Fractional\Test;

use Fractional\Fractional;
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
        Fractional::fractionFromString($invalidArguments);
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
        yield ['{-3/0}'];
        yield ['{-3/1}']; // TODO: review when this logic should work
        yield ['{3/-1}']; // TODO: review when this logic should work
    }

    /** @test */
    public function should_create_a_fraction_with_positive_values()
    {
        $validFraction = '{1/2}';
        $this->assertInstanceOf(Fractional::class, Fractional::fractionFromString($validFraction));
    }
}
