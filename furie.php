<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 22.02.2018
 * Time: 12:37
 */

function foo($w, $k, $a, $m)
{
    $n = pow(2,$k);

//    $a=strrev($a);
    $a=str_split($a);

    for ($i = 0; $i <= $n - 1; $i++) {
        $R[$i] = $a[$i];
    }

    for ($j = $k - 1; $j >= 0; $j--)
    {
        for ($i = 0; $i <= $n - 1; $i++) {
            $S[$i] = $R[$i];
        }
        for ($i = 0; $i <= $n - 1; $i++) {
            $i_ = base_convert($i, 10, 2);

            if(strlen($i_)<$k){
                while(strlen($i_)<$k){
                    $i_="0".$i_;
                }
            }

            $i_ = str_split($i_);
            $i_ = array_reverse($i_);
            $iw = $i_;

            $i_1 = $i_;
            $i_2 = $i_;

            $i_1[$j] = 0;
            $i_2[$j] = 1;

            $i_1 = array_reverse($i_1);
            $i_2 = array_reverse($i_2);

            $i_1 = implode($i_1);
            $i_2 = implode($i_2);

            $i_1 = base_convert($i_1, 2, 10);
            $i_2 = base_convert($i_2, 2, 10);

            $iw = array_reverse($iw);

            $iw=implode($iw);

            $iw=base_convert($iw,2,10);

            $iw=floor($iw/pow(2,$j));

            $iw=base_convert($iw,10,2);

            if(strlen($iw)<$k){
                while(strlen($iw)<$k){
                    $iw="0".$iw;
                }
            }
            $iw=strrev($iw);

            $iw=base_convert($iw,2,10);

            $iw=pow($w,$iw)%$m;

            $R[$i] = ($S[$i_1] + $iw*$S[$i_2])%$m;

        }
    }

    for ($i=0;$i<=$n-1;$i++){

        $i_=base_convert($i,10,2);

        if(strlen($i_)<$k){
            while(strlen($i_)<$k){
                $i_="0".$i_;
            }

        }
        $i_=strrev($i_);

        $i_=base_convert($i_,2,10);

        $b[$i]=$R[$i_];
    }

    return $b;
}

$b=foo(2,2,0123,5);

foreach ($b as $item) {
    echo $item.' ';
}
//$b=implode($b);
//echo "\n".$b;
