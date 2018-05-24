<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 24.05.2018
 * Time: 11:50
 */
function foo($n)
{
    $d=2*pow($n,1/3)+1;
    $d=17;
    if ($d%2==0){
        $d+=1;
    }
    $r1 = $n % $d;
    $r2 = $n % ($d - 2);
    $q = 4 * (floor($n / ($d - 2)) - floor($n / $d));
    $s = floor(sqrt($n));
    while (true) {
        $d += 2;
        if ($d > $s) {
            echo "Делителя нет";
            exit;
        }
        $r = 2 * $r1 - $r2 + $q;
        $r2 = $r1;
        $r1 = $r;
        if ($r1 < 0) {
            $r1 += $d;
            $q += 4;
        }
        while ($r1 >= $d) {
            $r1 -= $d;
            $q -= 4;
        }
        if ($r1 == 0) {
            return $d;
        }
    }
}

echo foo(75361);