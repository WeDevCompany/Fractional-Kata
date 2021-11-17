<?php

namespace Fractional\Test;

use Fractional\Fractional;
use PHPUnit\Framework\TestCase;

class FractionalTest extends TestCase
{

    /** @test */
    public function should_not_create_fraction_with_empty_string()
    {
        $this->expectException(\InvalidArgumentException::class);
        $invalidFraction = '';
        $fractional = new Fractional($invalidFraction);
    }
}
