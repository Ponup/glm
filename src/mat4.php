<?php
namespace glm;

class mat4 implements \ArrayAccess {

    private $data;

    public function __construct(array $data = null) {
        if($data == null) {
            $data = [
                [ 1.0, 0.0, 0.0, 0.0 ],
                [ 0.0, 1.0, 0.0, 0.0 ],
                [ 0.0, 0.0, 1.0, 0.0 ],
                [ 0.0, 0.0, 0.0, 1.0 ],
            ];
        }
        $this->data = $data;
    }

    public function multiply(mat4 $other) {
        $result = [
            [ 0, 0, 0, 0 ],
            [ 0, 0, 0, 0 ],
            [ 0, 0, 0, 0 ],
            [ 0, 0, 0, 0 ],
        ];
        $otherArray = $other->toArray();

        for($i = 0; $i < 4; $i++) {
            for($j = 0; $j < 4; $j++) {
                for($k = 0; $k < 4; $k++) {
                    $result[$i][$j] += $this->data[$i][$k] * $otherArray[$k][$j];
                }
            }
        }

        return new mat4($result);
    }

    public function toArray() {
        return $this->data;
    }

    public function __toString() {
        return sprintf('mat4x4((%f, %f, %f, %f), (%f, %f, %f, %f), (%f, %f, %f, %f), (%f, %f, %f, %f))',
            $this->data[0][0], $this->data[0][1], $this->data[0][2], $this->data[0][3],
            $this->data[1][0], $this->data[1][1], $this->data[1][2], $this->data[1][3],
            $this->data[2][0], $this->data[2][1], $this->data[2][2], $this->data[2][3],
            $this->data[3][0], $this->data[3][1], $this->data[3][2], $this->data[3][3]
        );
    }
    public function offsetExists($offset) {
        return ($offset >= 0 && $offset <= 3);
    }

    public function offsetGet($offset) {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value) {
    }

    public function offsetUnset($offset) {
    }

}

