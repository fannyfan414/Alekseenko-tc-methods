<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.04.2018
 * Time: 19:48
 */
function mersenn($n)
{
    $mn = pow(2, $n) - 1;
    echo "Число: " . $mn;
//    $nTestProst = gmp_prob_prime($mn, 10);
//    if ($nTestProst == 0) {
//        echo "\n Составное, т.к. n - составное";
//        exit;
//    }
    if ($n == 2) {
        echo "\n Простое";
        exit;
    }

    $d = 1;
    $i = 1;
    while ($d <= sqrt($mn)) {
        $d = 2 * $n * $i + 1;
        if (intdiv($mn, $d) == $mn / $d) {
            echo "\n Составное, делится на: " . $d;
            exit;
        }
        $i = $i + 1;
    }
    echo "\n Простое, т.к. не делится ни на что";

}

mersenn(13);