<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 14.05.2018
 * Time: 17:35
 */

function foo($n)
{
    $k = 0;
    $i = 1;
    while ($k <= $n) {


        $i++;
        $k++;
    }

}

function getMultiples($number)
{
    static $count;
    static $arr;
    static $del = 3;

    if ($number < 1) return false;
    $count = isset($count) ? ++$count : 1;
    if ($number == 1 && $count == 1) return [1];
    if ($number == 1 && $count > 1) return;
    if (!isset($arr)) $arr = [];

    // четные
    if ($number % 2 == 0) {
        $arr[] = 2;
        getMultiples($number / 2);
        return $arr;
    }

    // нечетные
    if ($number % $del == 0) {
        $arr[] = $del;
        getMultiples($number / $del);

        return $arr;
    }

    $del += 2;
    getMultiples($number);

    return $arr;
}

$number = 200;
echo $number . ' = ' . implode('*', getMultiples($number));