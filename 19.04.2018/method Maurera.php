<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 03.05.2018
 * Time: 8:53
 */
function Maurer($t){
    if($t<=20){
        $p=gmp_nextprime(gmp_pow(2,$t));
        return $p;
    }
    if ($t>40){
        $t_1 = random_int(floor($t/2)+1, $t-20);

    }
    else{
        $t_1=floor($t/2)+1;
    }
    $p=Maurer($t_1);

    $p=gmp_nextprime(gmp_pow(2,$t_1));


}