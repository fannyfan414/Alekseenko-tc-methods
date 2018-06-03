<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 31.05.2018
 * Time: 11:09
 */
function foo($n)
{
    $D = array();
    $numberforD = 6;
    $prime = 1;
    $D[0] = -1;
    $i = 1;
    while ($i < $numberforD) {
        $prime = gmp_nextprime($prime);
        if (gmp_legendre($n, $prime) == 1) {
            $D[$i] = gmp_intval($prime);
            $i++;
        }
    }

    $k = 1;
    $x = 0;
    while ($k < count($D) + 2) {
        if ($x == 0) {
            $arrayOfX = [$x];
        } else {
            $arrayOfX = [$x, -$x];
        }
        foreach ($arrayOfX as $xx) {
            $y = pow((floor(sqrt($n)) + $xx), 2) - $n;
            $factorOfy = getMultiples($y);
            $numbersofFactor = array_unique($factorOfy[0]);
            $kolvoofFactor = array_values($factorOfy[1]);
            if (!array_diff($numbersofFactor, $D)) {
                $S[$k] = floor(sqrt($n)) + $xx;

                if ($y > 0) {
                    $e[$k][0] = 0;
                } else {
                    $e[$k][0] = 1;
                }

                foreach ($kolvoofFactor as $thisKolvo){

                }
                for ($i = 1; $i < count($D); $i++) {

                }
                $e[$k] = $kolvoofFactor;
                $k++;
            }
        }
        $x++;
    }
    echo "";
}

function getMultiples($number)
{
    $arr = array();
    $arrCount = array();
    $del = 2;
    if ($number < 0) {
        $arr[0] = -1;
        $arrCount[0] = 1;
    }

    $number = abs($number);
    if ($number == 1) return [[1], [1]];
//    if($number==-1) return [[-1],[1]];
    while ($number > 1) {
        if ($number % $del == 0) {
            $arrCount[$del] += 1;
            $arr[] = $del;
            $number = $number / $del;

        } else {
            $del = gmp_intval(gmp_nextprime($del));
        }
    }
    return [$arr, $arrCount];
}

foo(81089);
//$x=getMultiples(-16);
//var_dump($x[0]);
//$newarray=array_values($x[1]);
//var_dump($newarray);
//$array1 = [1, 2, 3, 4];
//$array2 = [1, 2, 3, 4, 5];
//if (!array_diff($array1, $array2)) {
//    echo 'da';
//};

