<?php

namespace DelTesting\Common\Value;

use Codeception\TestCase\Test;
use Del\Common\Value\DecimalValue;
use Del\Common\Value\IntValue;
use Del\Common\Value\StringValue;

class AlertBoxTest extends Test
{
    public function testStringValue()
    {
        $value = new StringValue('Hello');
        $this->assertTrue(is_string($value->getValue()));
        $this->assertEquals('Hello',$value->getValue());
        $value = new StringValue(12345);
        $this->assertTrue(is_string($value->getValue()));
        $this->assertEquals('12345',$value->getValue());
    }

    public function testIntValue()
    {
        $value = new IntValue(123456);
        $this->assertTrue(is_int($value->getValue()));
        $this->assertEquals(123456,$value->getValue());
        $value = new IntValue('123456');
        $this->assertTrue(is_int($value->getValue()));
        $this->assertEquals(123456,$value->getValue());
        $this->setExpectedException('InvalidArgumentException');
        new IntValue('Not numeric');
    }

    public function testDecimalValue()
    {
        $value = new DecimalValue(1234);
        $this->assertTrue(is_float($value->getValue()));
        $this->assertEquals(1234.00,$value->getValue());
        $value = new DecimalValue(1234.56389);
        $this->assertTrue(is_float($value->getValue()));
        $this->assertEquals(1234.56,$value->getValue());
        $value = new DecimalValue('1234.56');
        $this->assertTrue(is_float($value->getValue()));
        $this->assertEquals(1234.56,$value->getValue());
        $this->setExpectedException('InvalidArgumentException');
        new DecimalValue('Not numeric');
    }
}
