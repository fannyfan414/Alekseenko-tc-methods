<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 29.03.2018
 * Time: 11:19
 */

function foo($n)
{
    for ($i = 0; $i < 3; $i++) {
        $a = rand(1, $n - 1);

        echo "\n число a:" . $a;
        if (gmp_gcd($a, $n) != 1) {
            echo "\n n - Составное";
            exit;
        }
        $an = bcpowmod($a, ($n - 1) / 2,$n);

        $anleg = gmp_legendre($a, $n);

        if ($anleg == -1) {
            $anleg += $n;
        }
        if ($an != gmp_legendre($a, $n)) {
            echo "\n n - составное";
            exit;
        }
        echo "\n ответ неизвестен";
    }
}
foo(652969351);
