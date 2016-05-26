<?php
namespace glm;

class vec3 implements \ArrayAccess {

    /**
     * @var float
     */
    public $x, $y, $z;

    /**
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct($x = 0.0, $y = 0.0, $z = 0.0) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function offsetExists($offset) {
        return ($offset >= 0 && $offset <= 2);
    }

    public function offsetGet($offset) {
        switch($offset) {
        case 0: return $this->x;
        case 1: return $this->y;
        case 2: return $this->z;
        }
    }

    public function offsetSet($offset, $value) {
    }

    public function offsetUnset($offset) {

    }

    public function ceil() {
        $this->x = ceil($this->x);
        $this->y = ceil($this->y);
        $this->z = ceil($this->z);
    }

    /**
     * @return vec3
     */
    public function negate() {
        return new vec3(
            -$this->x,
            -$this->y,
            -$this->z
        );
    }

    public function substract(vec3 $other) {
        return new vec3(
            $this->x - $other->x,
            $this->y - $other->y,
            $this->z - $other->z
        );
    }

    public function add(vec3 $other) {
        return new vec3(
            $this->x + $other->x,
            $this->y + $other->y,
            $this->z + $other->z
        );
    }

    /**
     * @return float
     */
    public function length() {
        return sqrt($this->x * $this->x + $this->y * $this->y + $this->z * $this->z);
    }

    public function lengthSq() {
        return ($this->x * $this->x + $this->y * $this->y + $this->z * $this->z);
    }

    public function normalize() {
        $length = $this->length();
        if($length == 0) {
            trigger_error('Vector length is 0, returning without modifying components', E_USER_NOTICE);
            return $this;
        }
        $this->x = $this->x / $length;
        $this->y = $this->y / $length;
        $this->z = $this->z / $length;
        return $this;
    }

    public function cross(vec3 $other) {
        return new vec3(
            $this->y * $other->z - $this->z * $other->y,
            $this->z * $other->x - $this->x * $other->z,
            $this->x * $other->y - $this->y * $other->x
        );
    }

    /**
     * @param number $number
     * @return vec3
     */
    public function scale($number) {
        if(!is_numeric($number)) {
            throw new \Exception('Invalid scalar: ' . $number);
        }
        return new vec3(
            $this->x * $number,
            $this->y * $number,
            $this->z * $number
        );
    }

    public function dot(vec3 $other) {
        return ($this->x * $other->x + $this->y * $other->y + $this->z * $other->z);
    }

    public function toArray() {
        return array( $this->x, $this->y, $this->z );
    }

    public function __toString() {
        return sprintf('vec3(%f, %f, %f)', $this->x, $this->y, $this->z);
    }
}

