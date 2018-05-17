<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 29.03.2018
 * Time: 8:50
 */
function foo($u, $v, $n)
{
    $l = floor($n / 2);
    $k = $n - $l;
    $K = pow(2, $k);
    $L = pow(2, $l);
    $N = pow(2, $n);
    $u = base_convert($u, $N, pow(2, $L));
    $v = base_convert($v, $N, pow(2, $L));
    while (strlen($u) < $K) {
        $u = "0" . $u;
    }
    $u = strrev($u);

    $u = str_split($u);
    while (strlen($v) < $K) {
        $v = "0" . $v;
    }
    $v = strrev($v);
    $v = str_split($v);

    $W = array();
    for ($i = 0; $i <= $K - 1; $i++) {
        for ($j = 0; $j <= $i; $j++) {
            $W[$i] += ($u[$i - $j] * $v[$j]);
        }
        for ($j = $i + 1; $j <= $K - 1; $j++) {
            $W[$i] -= $u[$i + $K - $j] * $v[$j];
        }
    }
    for ($i = 0; $i <= $K - 1; $i++) {
        $W_[$i] = $W[$i] % $K;
    }
    $psi = pow(2, (2 * $L) / $K);

    for ($i = 0; $i <= $K - 1; $i++) {
        $u_[$i] = $u[$i] * pow($psi, $i);
        $v_[$i] = $v[$i] * pow($psi, $i);
    }
    $m = pow(2, 2 * $L) + 1;
    $w = pow(2, 4 * $L / $K);
//    $u_=implode($u_);
//    $v_=implode($v_);
    $u__ = furie($w, $k, $u_, $m);
    $v__ = furie($w, $k, $v_, $m);
    for ($i = 0; $i < count($u__); $i++) {
        $c[$i] = ($u__[$i] * $v__[$i]) % $m;
    }

    $d = revFurie($w, $k, $c, $m);

    for ($i = 0; $i <= $K - 1; $i++) {
        $W__[$i] = $d[$i] * pow($psi, -$i);
    }
    for ($i = 0; $i <= $K - 1; $i++) {
        $W___[$i] = (pow(2, 2 * $L) + 1) * (($W_[$i] - $W__[$i]) % $K) + $W__[$i];
        if ($W___[$i] < ($i + 1) * pow(2, 2 * $L)) {
            $W[$i] = $W___[$i];
        } else {
            $W[$i] = $W___[$i] - $K * (pow(2, 2 * $L) + 1);
        }
    }
    $y=0;
    for ($i = 0; $i <= 2 * $K - 1; $i++) {
        $y+= $W[$i] * pow(2, $L * $i);
    }
    return $y;
}

function furie($w, $k, $a, $m)
{
    $n = pow(2, $k);
//    $a=strrev($a);
//    $a = str_split($a);
    for ($i = 0; $i <= $n - 1; $i++) {
        $R[$i] = $a[$i];
    }
    for ($j = $k - 1; $j >= 0; $j--) {
        for ($i = 0; $i <= $n - 1; $i++) {
            $S[$i] = $R[$i];
        }
        for ($i = 0; $i <= $n - 1; $i++) {
            $i_ = base_convert($i, 10, 2);
            if (strlen($i_) < $k) {
                while (strlen($i_) < $k) {
                    $i_ = "0" . $i_;
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
            $iw = implode($iw);
            $iw = base_convert($iw, 2, 10);
            $iw = floor($iw / pow(2, $j));
            $iw = base_convert($iw, 10, 2);
            if (strlen($iw) < $k) {
                while (strlen($iw) < $k) {
                    $iw = "0" . $iw;
                }
            }
            $iw = strrev($iw);
            $iw = base_convert($iw, 2, 10);
            $iw = pow($w, $iw) % $m;
            $R[$i] = ($S[$i_1] + $iw * $S[$i_2]) % $m;
        }
    }
    for ($i = 0; $i <= $n - 1; $i++) {
        $i_ = base_convert($i, 10, 2);
        if (strlen($i_) < $k) {
            while (strlen($i_) < $k) {
                $i_ = "0" . $i_;
            }
        }
        $i_ = strrev($i_);
        $i_ = base_convert($i_, 2, 10);
        $b[$i] = $R[$i_];
    }
    return $b;
}

function revFurie($w, $k, $a, $m)
{
    $n = pow(2, $k);
    $w_ = revmod($w, $m);
    $n_ = revmod($n, $m);
    $b = furie($w_, $k,$a, $m);
    $bb = array();
    for ($i = 0; $i <= $n - 1; $i++) {
        $bb[$i] = ($n_ * $b[$i]) % $m;
    }
    return $bb;
}

function revmod($a, $mod)
{
    $t = 1; //индикатор для выхода из while
    $m_ = 1; //числитель
    if ($a > $mod) { //Сокращаем знаменатель если можно по модулю
        $a = $a % $mod; //деление по модулю
    }
    if ($a < 0) $a += $mod;

    while ($t == 1) {
        $m_ += $mod; //Прибавляем к числителю модуль
        if ($m_ / $a == floor($m_ / $a)) { //Смотрим делится ли нацело
            $t = 2; //Если да то выходим из цикла
        }
    }
    $y = $m_ / $a;
    return $y;
}


echo $x = foo(5, 18, 4);
