<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 24.05.2018
 * Time: 10:59
 */
function foo($n)
{
    $prime = 1;
    $t = 0;
    $k = 1;
    $p = array();
    $d = array();
//    for ($i = 1; $i <= $number_del; $i++) {
//        $prime = gmp_intval(gmp_nextprime($prime));
//        $d[$i] = $prime;
//    }
    for ($i = 1; $i <= floor(sqrt($n)); $i++) {
        $prime = gmp_intval(gmp_nextprime($prime));
        $d[$i] = $prime;
    }
    while (true) {
        if ($n == 1) {
            return $p;
        }
        $r = $n % $d[$k];
        $q = floor($n / $d[$k]);
        if ($r == 0) {
            $t++;
            $p[$t] = $d[$k];
            $n = $q;
        } else {
            if ($q > $d[$k]) {
                $k++;
            } else {
                $t++;
                $p[$t] = $n;
                return $p;
            }
        }
    }
}

$end = foo(75361);
echo implode('*',$end);
