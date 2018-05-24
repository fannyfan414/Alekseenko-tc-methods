<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 14.05.2018
 * Time: 17:35
 */

function foo($n)
{
    $massiv = array();
    $k = 0;
    $number = 1;
    while ($k < $n) {
        if (FermEiler(getMultiples($number))) {
            $massiv[] = $number;
            $k++;
        }
        $number += 1;
    }
    return [$k, $massiv];
}

function getMultiples($number)
{

    $arr = array();
    $arrCount = array();
    $del = 2;

    if ($number == 1) return [[1], [1]];
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

function FermEiler($arr)
{
    $numbers = array_unique($arr[0]);
    $numberCount = $arr[1];
    $k = 0;
    $specNumber = 0;
    while ($specNumber <= $numbers[count($numbers) - 1]) {
        $specNumber = 4 * $k + 3;
        if (array_search($specNumber, $numbers) !== false && ($numberCount[$specNumber] % 2 != 0)) {
            return false;
        }
        $k++;
    }
    return true;
}

$x = foo(10);
echo implode(" ", $x[1]);


//$x=(getMultiples(gmp_fact(20)));
//echo implode("*",$x[0]);
//echo "\n".implode("*",$x[1]);
//var_dump(getMultiples(4));