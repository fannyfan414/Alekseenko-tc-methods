<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 22.02.2018
 * Time: 12:37
 */

function foo($w, $k, $a)
{
    $n = strlen($a);

    $a=strrev($a);
    $a=str_split($a);

    for ($i = 0; $i <= $n - 1; $i++) {
        $R[$i] = $a[$i];
    }
    for ($j = $k - 1; $j >= 0; $j--) {

        for ($i = 0; $i <= $n - 1; $i++) {
            $S[$i] = $R[$i];
        }
        for ($i = 0; $i <= $n - 1; $i++) {
            $i_ = base_convert($i, 10, 2);

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

            unset($iw[$j]);
            $iw = array_reverse($iw);
            $iw=implode($iw);

            $R[$i] = $S[$i_1] + pow($w,base_convert($iw,2,10))*$S[$i_2];

//            echo " i ".$i_1." S ".$S[$i_1]." w ".pow($w,$iw)."--";
//            echo " i " .$i_2." S ".$S[$i_2]."---";
        }
    }

    for ($i=0;$i<=$n-1;$i++){
        $i_=base_convert($i,10,2);
        $i_=strrev($i_);
        $i_=base_convert($i_,2,10);

        $b[$i]=$R[$i_];
    }

    return $b;
}

$b=foo(2,2,1234);
$b=implode($b);
echo $b;