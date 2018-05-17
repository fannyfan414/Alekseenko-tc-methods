<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 17.05.2018
 * Time: 11:03
 */

function pollard($n,$c){
    $d=1;
    $a=$c;
    $b=$c;
    while ($d==1){
        $a=f($a)%$n;
        $b=f($b)%$n;
        $b=f($b)%$n;
        $d=gmp_gcd($a-$b,$n);
        if(1<$d and $d<$n){
            $p=$d;
            echo $p;
            exit;
        }
        if($d==$n) {
            echo "Делитель не найден";
            exit;
        }
    }
}
function f($x){
    return pow($x,2)+1;
}
pollard(10283,2);