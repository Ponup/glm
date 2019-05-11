<?php
namespace glm;

abstract class vec implements \ArrayAccess
{
    const PropertyMap = [
        'x' => 0,
        'y' => 1,
        'z' => 2,
        'w' => 3
    ];

    /**
     * @var array
     */
    protected $data;

    public function __construct(int $numComponents)
    {
        $this->data = array_fill(0, $numComponents, 0);
    }

    public function negate()
    {
        $vec = new static;
        $vec->data = array_map(function ($value) {
            return -$value;
        }, $this->data);
        return $vec;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function __toString(): string
    {
        return sprintf('%s(%s)', get_class($this), implode(', ', $this->data));
    }

    public function __get($name)
    {
        $index = self::PropertyMap[$name];
        if (array_key_exists($index, $this->data)) {
            return $this->data[$index];
        }

        return null;
    }

    public function __set($name, $value)
    {
        $index = self::PropertyMap[$name];
        $this->data[$index] = $value;
    }

    public function offsetExists($offset): bool
    {
        return ($offset >= 0 && $offset <= 2);
    }

    public function offsetGet($offset)
    {
        switch ($offset) {
            case 0:
                return $this->x;
            case 1:
                return $this->y;
            case 2:
                return $this->z;
        }
    }

    public function offsetSet($offset, $value)
    { }

    public function offsetUnset($offset)
    { }
}
