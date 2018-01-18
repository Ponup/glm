<?php
namespace glm;

class GlobalsTest extends \PHPUnit\Framework\TestCase {

    public function testLookAt() {
        $a = lookAt(vec3(1,1,1), vec3(2,2,3), vec3(4,4,4));
        $this->assertNotNull($a);
    }
}

