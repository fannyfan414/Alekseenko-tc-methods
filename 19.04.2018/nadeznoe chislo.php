<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.04.2018
 * Time: 20:37
 */

function foo($q)
{
    $p = 2 * $q + 1;
    echo "Число p:" . $p;
    if ($q % 4 == 1 && bcpowmod(2, $q, $p) - $p == -1) {
        echo "\n Надежное простое";
        exit;
    }


    if ($q % 4 == 3 && bcpowmod(-2, $q, $p) == -1) {
        echo "\n Надежное простое";
        exit;
    }
    echo "\n Ненадежное";
}
foo(53);