<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 19.04.2018
 * Time: 11:52
 */
function foo()
{
    $randomInt = random_int(pow(2, 10), pow(2, 15));
    $s = gmp_nextprime($randomInt);
    $t = gmp_nextprime($s);
    echo "s:".$s;
    echo "\n t:".$t;

    $i0 = random_int(10, 15);

    $i = $i0;

    while (true){
        $r=(2*$i)*$t+1;

        if (isPrime($r)){
            break;
        }
        $i++;
    }
    echo "\n r:".$r;
    $p0 = 2 * (bcpowmod($s, $r - 2, $r)) * $s - 1;

    $j0 = random_int(1, 10);

    $j=$j0;
    while (true){
        $p = (2 * ($j * $r)) * $s + $p0;
        if (isPrime($p)){
            echo "\n p:".$p;
            break;
        }
        $j++;
    }
}

function isPrime($x)
{
    $prime = 1;
    $sqrt=floor(gmp_sqrt($x))+1;
    for ($i = 0; $i <= $sqrt; $i++) {
        $prime = gmp_nextprime($prime);
        if ($x % $prime == 0) {
            return false;
            break;
        }
    }
    return true;
}

foo();
//isPrime(5011);
