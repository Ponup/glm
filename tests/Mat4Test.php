<?php
namespace glm;

class Mat4Test extends \PHPUnit\Framework\TestCase {

    public function testConstructorDefaultsToIdentityMatrix() {
        $matrix = new mat4;
        $expectedArray = array(
            array( 1, 0, 0, 0 ),
            array( 0, 1, 0, 0 ),
            array( 0, 0, 1, 0 ),
            array( 0, 0, 0, 1 ),
        );
        $this->assertEquals($expectedArray, $matrix->toArray());
    }

    public function testStringFormat() {
        $matrix = new mat4;
        $this->assertEquals('mat4x4((1.000000, 0.000000, 0.000000, 0.000000), (0.000000, 1.000000, 0.000000, 0.000000), (0.000000, 0.000000, 1.000000, 0.000000), (0.000000, 0.000000, 0.000000, 1.000000))', strval($matrix));
    }
}
