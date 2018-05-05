<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 29.03.2018
 * Time: 8:50
 */

function foo($u,$v,$n){
    $l=intdiv($n/2);
    $k=$n-$l;
    $K=pow(2,$k);
    $L=pow(2,$l);
    $u=base_convert($u,pow(2,$l));
    $v=base_convert($v,pow(2,$l));

    while(strlen($u)<$K){
        $u="0".$u;
        }
    while(strlen($v)<$K){
        $v="0".$v;
        }



}
