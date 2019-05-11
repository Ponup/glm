<?php
namespace glm;

class Vec2Test extends \PHPUnit\Framework\TestCase
{
    public function testDefaultInitialisation()
    {
        $vec = new vec2;
        $this->assertSame(0, $vec->x);
        $this->assertSame(0, $vec->y);
    }

    public function testConstructorValues()
    {
        $vec = new vec2(5, 10);
        $this->assertEquals(5, $vec->x);
        $this->assertEquals(10, $vec->y);
    }

    public function testNegation()
    {
        $vec = new vec2(100, 39);
        $negation = $vec->negate();
        $this->assertEquals(-100, $negation->x);
        $this->assertEquals(-39, $negation->y);
    }

    public function testStringRepresentation()
    {
        $vec = vec2(3.14, -99);
        $this->assertEquals('glm\vec2(3.14, -99)', (string)$vec);
    }
}
