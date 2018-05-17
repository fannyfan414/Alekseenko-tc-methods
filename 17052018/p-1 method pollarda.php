<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 17.05.2018
 * Time: 11:14
 */

function pollardP_1($n)
{
    $p = array();
    $s = 4;
    $p[1] = 2;
    for ($i = 2; $i <= $s; $i++) {
        $p[$i] = gmp_nextprime($p[$i - 1]);
    }

    $a =rand(2, $n - 2);
//    $a=2;
    $d = gmp_gcd($a, $n);
    if ($d >= 2) {
        $p = $d;
        return $p;
    }
    for ($i = 1; $i <= $s; $i++) {
        $l = floor(gmp_div(log($n), log($p[$i])));
        $a = gmp_mod(gmp_pow($a, gmp_pow($p[$i], $l)), $n);
    }
    $d = gmp_gcd($a - 1, $n);
    if ($d == 1 or $d == $n) {
        return false;
    }
    else {
        $p = $d;
        return $p;
    }
}

$k=0;
while ($k==0){
    $p=pollardP_1(5300159);
    if(!($p===false)){
        echo "Ответ:".$p;
        $k=1;
    }
}

echo "";