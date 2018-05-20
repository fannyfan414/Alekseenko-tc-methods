<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 14.05.2018
 * Time: 17:35
 */

function foo($n)
{
    $massiv=array();
    $k = 0;
    $number = 1;
//    $prime = 2;
    while ($k < $n) {
        if(FermEiler(getMultiples($number))){
           $massiv[]=$number;
           $k++;
        }
        $number+=1;
    }
//    while ($k < $n) {
//        $prime = gmp_nextprime($prime);
//        if (gmp_mod($prime, 4) != 1) {
//            echo "\n".$prime;
//            $k++;
//        }
//
//    }
    return [$k,$massiv];
}

function getMultiples($number)
{
    static $count;
    static $arr;
    static $arrCount;
    static $del = 2;

    if ($number < 1) return false;
    $count = isset($count) ? ++$count : 1;
    if ($number == 1 && $count == 1) return [[1],[1]];
    if ($number == 1 && $count > 1) return;
    if (!isset($arr)) $arr = [];
    if (!isset($arrCount)) $arrCount = [];

    if ($number % $del == 0) {
        $arr[] = $del;
        $arrCount[$del] += 1;
        getMultiples(gmp_intval($number / $del));
        return [$arr, $arrCount];
    }

    $del = (gmp_nextprime($del));
    getMultiples($number);
    return [$arr, $arrCount];
}

function FermEiler($arr)
{
    $numbers = array_unique($arr[0]);
    $numberCount = $arr[1];
    $k = 0;
    $specNumber = 0;
    while ($specNumber <= $numbers[count($numbers) - 1]) {
        $specNumber = 4 * $k + 3;
        if (array_search($specNumber, $numbers)!==false && ($numberCount[$specNumber] % 2 != 0)) {
            return false;
        }
        $k++;
    }
    return true;
}

//$x=foo(4);
//echo implode(" ",$x[1]);
//var_dump(foo(3));
//var_dump(FermEiler(getMultiples(4)));