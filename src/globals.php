<?php
namespace glm;

use \glm\vec3;
use \glm\mat4;

function vec3($x, $y, $z) {
    return new vec3($x, $y, $z);
}

function vec3fromArray(array $a) {
    return new vec3($a[0], $a[1], $a[2]);
}

function cross(vec3 $a, vec3 $b) {
    return $a->cross($b);
}

function normalize(vec3 $a) {
    return $a->normalize();
}

function radians($degrees) {
    return deg2rad($degrees);
}

function lookAt(vec3 $eye, vec3 $center, vec3 $up) {
    $cameraDirection = $eye->substract( $center )->normalize();
    $cameraRight = $up->cross( $cameraDirection )->normalize();
    $cameraUp = $cameraDirection->cross( $cameraRight );//->normalize();
    $orientation = new mat4([
        [ $cameraRight->x, $cameraUp->x, $cameraDirection->x, 0 ],
        [ $cameraRight->y, $cameraUp->y, $cameraDirection->y, 0 ],
        [ $cameraRight->z, $cameraUp->z, $cameraDirection->z, 0 ],
        [ 0, 0, 0, 1.0 ],
    ]);
    $translation = new mat4([
        [ 1, 0, 0, 0 ],
        [ 0, 1, 0, 0 ],
        [ 0, 0, 1, 0 ],
        [ -$cameraRight->dot( $eye ), -$cameraUp->dot( $eye ), -$cameraDirection->dot( $eye ), 1 ],
    ]);
    return $orientation->multiply($translation);
}

function perspective($fovy, $aspect, $zNear, $zFar) {
    $fovy = deg2rad($fovy);
    $f = 1 / tan($fovy / 2);
    
    $result = new mat4([
        [ $f / $aspect, 0, 0, 0, ],
        [ 0, $f, 0, 0 ],
        [ 0, 0, ($zFar + $zNear)/($zNear - $zFar), -1 ],
        [ 0, 0, (-2 * $zFar * $zNear)/($zFar - $zNear), 0 ]
    ]);
    return $result;
}

function translate(mat4 $m, vec3 $v) {
    $translation = new mat4([
        [ 1.0, 0.0, 0.0, 0 ],
        [ 0.0, 1.0, 0.0, 0 ],
        [ 0.0, 0.0, 1.0, 0 ],
        [ $v->x, $v->y, $v->z, 1.0 ]
    ]);

    return $translation->multiply($m);
}

function scale(mat4 $m, vec3 $v) {

    $d = value_ptr($m);

    return new mat4([
        [$d[0] * $v->x, $d[1] * $v->x, $d[2] * $v->x, $d[3] * $v->x],
        [$d[4] * $v->y, $d[5] * $v->y, $d[6] * $v->y, $d[7] * $v->y],
        [$d[8] * $v->z, $d[9] * $v->z, $d[10] * $v->z, $d[11] * $v->z],
        [$d[12], $d[13], $d[14], $d[15]]
    ]);
}

function rotate(mat4 $m, $angle, vec3 $normal) {
    $angle = deg2rad($angle);
    if($normal->x) {
        $rotation = new mat4([
            [ 1.0, 0.0, 0.0, 0.0 ],
            [ 0, cos($angle), -sin($angle), 0 ],
            [ 0, sin($angle), cos($angle),  0 ],
            [ 0.0, 0.0, 0.0, 1.0 ]
        ]);
        $rotation = $rotation->multiply($m);
    }
    if($normal->y) {
        $rotation = new mat4([
            [ cos($angle), 0, sin($angle), 0 ],
            [ 0.0, 1.0, 0.0, 0.0 ],
            [ -sin($angle), 0, cos($angle), 0 ],
            [ 0.0, 0.0, 0.0, 1.0 ]
        ]);
        $rotation = $rotation->multiply($m);
    }
    if($normal->z) {
        $rotation = new mat4([
            [ cos($angle), -sin($angle), 0.0, 0 ],
            [ sin($angle), cos($angle), 0.0, 0 ],
            [ 0.0, 0.0, 1.0, 0.0 ],
            [ 0.0, 0.0, 0.0, 1.0 ]
        ]);
        $rotation  =$rotation->multiply($m);
    }
    return $rotation;
}

function value_ptr(mat4 $matrix) {
    $array = $matrix->toArray();
    return array_merge($array[0], $array[1], $array[2], $array[3]);
}

