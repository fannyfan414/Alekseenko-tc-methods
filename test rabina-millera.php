<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 29.03.2018
 * Time: 11:46
 */
function foo($n){

    $t=$n-1;

    $s=0;
    while ($t%2==0){
        $s+=1;
        $t= $t/2;
    }

    for ($i = 0; $i < 3; $i++) {
        $a = rand(1, $n - 1);

        echo "\n число a:" . $a;
        if (gmp_gcd($a, $n) != 1) {
            echo "\n n - Составное";
            exit;
        }
        $k=0;
        $at=bcpowmod($a,$t,$n);
        if ($at>1) $at-=$n;
        if ($at==1 || $at==-1) $k=2;
        for ($i=2;$i<=$s-1;$i++){
            $at=bcpowmod(pow($a,$t),pow(2,$i),$n);
            if($at>1) $at-=$n;
            if ($at==-1) {
                echo "ответ неизвестен";
                $k=-1;
                exit;
            }
        }
        if ($k=0)echo "ответ составное";
    }

}

foo(2683);