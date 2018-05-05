<?php

function expMonth($m,$y,$x, $b){


    $m_ = mod($m, $b);
    $k = strlen($m);
    $n=strlen($y);
    $r2=pow($b,2*$k) % $m;

    $x_=multiplyMonth($m,$b,$x,$r2);
    $z=$x_;


    for($i=$n-2;$i>=0;$i--){
        $q=pow($z,2);
        $z=preobrMonth($m,$b,$q);
        $y=str_split($y);
        $y=array_reverse($y);
        if($y[$i]==1){
            $z=multiplyMonth($m,$b,$z,$x_);
        }
        $y=array_reverse($y);
        $y=implode($y);

    }
    $z=preobrMonth($m,$b,$z);
    return $z;

}

function mod($m, $b)
{
    if (gmp_gcd($m, $b) == 1) { //Если нод =1

        $t = 1; //индикатор для выхода из while
        $m_ = -1; // т.к. когда мы переворачиваем число -17 например, в числителе всегда будет -1
        if ($m > $b) { //Сокращаем знаменатель если можно по модулю
            $m = $m % $b; //деление по модулю
        }

        while ($t == 1) {
            $m_ += $b; //Прибавляем к числителю модуль
            if ($m_ / $m == floor($m_ / $m)) { //Смотрим делится ли нацело
                $t = 2; //Если да то выходим из цикла
            }
        }
        $y = $m_ / $m;
        return $y;
    } else {
        echo "NOD $m and $b not 1";
    }
}

function multiplyMonth($m, $b, $x, $y)
{
    if ($x<$m and $y<$m){
        $x = str_split($x);
        $y = str_split($y);

        $x = array_reverse($x);
        $y = array_reverse($y);

        $k = strlen($m);
        $m_ = mod($m, $b); //Находим m'

        $z = 0;

        for ($i = 0; $i <= $k - 1; $i++) {

            $z=str_split($z);
            $z=array_reverse($z);

            $u = (($z[0] + $x[$i] * $y[0]) * $m_) % $b;
            echo $u; echo '--';
            $y = array_reverse($y);
            $y = implode($y);
            $z=array_reverse($z);
            $z=implode($z);

            $z = ($z + $x[$i] * $y + $u * $m) / $b;

            $y = str_split($y);
            $y = array_reverse($y);


        }
        if ($z >= $m) $z -= $m;
        return $z;
    }
    else return null;

}

function preobrMonth($m, $b, $x)
{
    $k = strlen($m); //Длина числа m
    $y = array_reverse($x); //Переворачиваем массив, т.к. нумерация справа налево

    $m_ = mod($m, $b); //Находим m'

    for ($i = 0; $i <= $k - 1; $i++) {
        $u = ($y[$i] * $m_) % $b;
        $y = array_reverse($y); //опять переворачиваем
        $y = implode($y); //Преобразуем массив в строку (обычн число)
        $y += ($u * $m) * pow($b, $i);
        $y = str_split($y); //Преобразуем строку опять в массив
        $y = array_reverse($y); //Опять переворачиваем
    }
    $y = array_reverse($y); //Опять переворачиваем
    $y = implode($y); //Преобразуем массив в строку
    $y = floor($y / pow($b, $k)); //Находим целое от ...
    if ($y >= $m) {
        $y -= $m;
    }
    return $y;
}

echo expMonth(17,1001,2,10);