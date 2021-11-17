<?php

namespace KataTemplate\Test;

use KataTemplate\KataTemplate;
use PHPUnit\Framework\TestCase;

class KataTemplateTest extends TestCase
{
    /** @test */
    public function change_me()
    {
        $kataTemplate = new KataTemplate();
        $this->assertTrue($kataTemplate->changeMe());
    }
}
