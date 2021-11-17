<?php

namespace Fractional\Test;

use Fractional\Fractional;
use PHPUnit\Framework\TestCase;

class FractionalTest extends TestCase
{
    /** @test */
    public function change_me()
    {
        $fractional = new Fractional();
        $this->assertTrue($fractional->changeMe());
    }
}
