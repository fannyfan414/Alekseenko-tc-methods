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
    while (strlen($v) < $K) {
        $v = "0" . $v;
    }
    $W = $u[-]$v;   // Свертка векторов
    for ($i = 0; $i <= $K - 1; $i++) {
        $W_[$i] = $W[$i] % $K;
    }
    for ($i = 0; $i <= $K - 1; $i++) {
        $psi = pow(2, 2 * $L / $K);
        $u_[$i] = $u[$i] * pow($psi, $i);
        $v_[$i] = $v[$i] * pow($psi, $i);
    }
    $m = pow(2, 2 * $L) + 1;
    $w = pow(2, 4 * $L / $K);
    $u__ = furie($w, , $u_, $m); // ШО ВМЕСТО K?
    $v__ = furie($w, , $v_, $m);
    for ($i = 0; $i < strlen($u); $i++) {
        $c[$i] = $u__[$i] * $v__[$i];
    }
    $d = furie_v_minus1($c); //ФУРЬЕ В МИНУС 1?
    $w_v_minus1 = -pow(2, 2 * $L - 2 * $L / $K);
    $K_v_minus1 = -pow(2, 2 * $L - $k);
    $psi_v_minus1 = -pow(2, 2 * $L - 2 * $L / $K);
    for ($i = 0; $i <= $K - 1; $i++) {
        $W__[$i] = $d[$i] * pow($psi_v_minus1, $i);
    }
    for ($i = 0; $i <= $K - 1; $i++) {
        $W___[$i] = (pow(2, 2 * $L) + 1) * (($W_[$i] - $W__[$i]) % $K) + $W__[$i];
        if ($W___[$i] < ($i + 1) * pow(2, 2 * $L)) {
            $W[$i] = $W___[$i];
        } else {
            $W[$i] = $W___[$i] - $K * (pow(2, 2 * $L) + 1);
        }
    }
    for ($i = 0; $i <= 2 * $K - 1; $i++) {
        $y[$i] = $W[$i] * pow(2, $L * $i);
    }
    return $y;
}
function furie($w, $k, $a, $m)
{
    $n = pow(2, $k);
//    $a=strrev($a);
    $a = str_split($a);
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