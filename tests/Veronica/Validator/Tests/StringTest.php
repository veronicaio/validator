<?php

namespace Veronica\Validator\Tests;

/**
 *
 * Test class for Veronica Validator
 *
 * @version 5.0.0
 *
 */

use PHPUnit\Framework\TestCase;

use Veronica\Validator\Text;

class StringTest extends TestCase
{

    protected Text $value;

    public function setUp(): void
    {
        $this->value = new Text();
    }

    public function testIsString()
    {
        $this->assertTrue($this->value->isString('string'));
        $this->assertFalse($this->value->isString(5));
        $this->assertFalse($this->value->isString([]));
        $this->assertFalse($this->value->isString(true));
        $this->assertFalse($this->value->isString(false));
        $this->assertFalse($this->value->isString(null));
        $this->assertFalse($this->value->isString(new \stdClass()));
    }
}


