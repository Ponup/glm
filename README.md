[![Build Status](https://travis-ci.org/Ponup/glm.svg?branch=master)](https://travis-ci.org/Ponup/glm)

# PHP GLM

A port of the GLM library to the PHP language.

## Example usage

```php
<?php

require 'vendor/autoload.php';

use glm\vec3;
use glm\mat4;

$matrix = new mat4; // 4x4 identity matrix

echo $matrix, PHP_EOL;
// Output: mat4x4((1.000000, 0.000000, 0.000000, 0.000000), (0.000000, 1.000000, 0.000000, 0.000000), (0.000000, 0.000000, 1.000000, 0.000000), (0.000000, 0.000000, 0.000000, 1.000000))

echo $matrix->scale(5), PHP_EOL;
// Output: mat4x4((5.000000, 0.000000, 0.000000, 0.000000), (0.000000, 5.000000, 0.000000, 0.000000), (0.000000, 0.000000, 5.000000, 0.000000), (0.000000, 0.000000, 0.000000, 1.000000))
```
