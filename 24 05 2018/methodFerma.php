<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 24.05.2018
 * Time: 12:06
 */
function foo($n)
{
    $x = floor(sqrt($n));
    if (pow($x, 2) == $n) {
        echo "a=b=" . $x;
        exit;
    }
    while (true) {
        $x += 1;
        if ($x == (($n + 1) / 2)) {
            echo $n . "-простое";
            exit;
        } else {
            $z = pow($x, 2) - $n;
            $y = floor(sqrt($z));
        }
        if (pow($y, 2) == $z) {
            $a = $x + $y;
            echo "a:" . $a;
            $b = $x - $y;
            echo "\n";
            echo "b:" . $b;
            exit;
        }
    }
}

foo(75361);