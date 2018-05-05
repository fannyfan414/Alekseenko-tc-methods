<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 05.04.2018
 * Time: 11:43
 */
function foo($n, $t)
{
    $n_1 = $n - 1;
    $k = 0;
    $prime = 1;
    $A = array();
    for ($i = 0; $i < floor(sqrt($n_1)) + 1; $i++) {
        $nextPrime = gmp_nextprime($prime);
        if ($n_1 / $nextPrime == floor($n_1 / $nextPrime)) {
            $A[$i] = $nextPrime;
            $k += 1;
        }
        $prime = $nextPrime;
    }

    for ($i = 0; $i < $t; $i++) {
        $a = rand(2, $n - 2);
        if (gmp_powm($a, $n - 1, $n) != 1) {
            echo "\n n - составное";
            exit;
        }

        for ($j = 0; $j < $k; $j++) {
            if (gmp_powm($a, ($n - 1) / $A[$j], $n) != 1) {
                echo "\n n - простое";
                exit;
            }
        }
    }
    echo "\n n - простое";
}

foo(100, 4);