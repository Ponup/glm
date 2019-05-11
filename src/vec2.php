<?php
namespace glm;

class vec2 extends vec
{
    public function __construct($x = 0, $y = 0)
    {
        parent::__construct(2);

        $this->x = $x;
        $this->y = $y;
    }
}
