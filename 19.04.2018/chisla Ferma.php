<?php

function ferma($n)
{
    $fn = pow(2, pow(2, $n)) + 1;
    echo "Число fn: " . $fn;
    $test1 = bcpowmod(3, ($fn - 1) / 2, $fn);
    if ($test1 - $fn == -1) {
        echo "\n Теорема Пепина - число простое";
        exit;
    }
    $d = 1;
    $i = 1;
    while ($d <= sqrt($fn)) {
        $d = 2 * $n * $i + 1;
        if (intdiv($fn, $d) == $fn / $d) {
            echo "\n Составное, делится на: " . $d;
            exit;
        }
        $i = $i + 1;
    }
    echo "\n Число не простое";
}

ferma(5);
