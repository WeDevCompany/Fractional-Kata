<?php

namespace Fractional\Test;

use Fractional\Fractional;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FractionalTest extends TestCase
{

    /** @test */
    public function should_not_create_fraction_with_empty_string()
    {
        $this->expectException(InvalidArgumentException::class);
        $invalidFraction = '';
        Fractional::fractionFromString($invalidFraction);
    }

    /** @test */
    public function should_not_create_fraction_with_only_one_bracket()
    {
        $this->expectException(InvalidArgumentException::class);
        $invalidFraction = '{';
        Fractional::fractionFromString($invalidFraction);
    }
}
