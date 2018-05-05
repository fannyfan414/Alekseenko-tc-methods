<?php

function foo($x, $m, $b, $t, $c)
{

    $q = floor($x / pow($b, $t));

    $r = $x % pow($b, $t);
    while ($q > 0) {
        $qc = $q * $c;
        $q_ = floor($qc / pow($b, $t));
        $r_ = $qc % pow($b, $t);
        $r = $r + $r_;
        $q = $q_;
    }


    while ($r >= $m) {
        $r = $r- $m;
    }
    return $r;
}

$b = 10;
$t=3;
$c=101;
$x=2525;
$m=pow($b,$t)-$c;

$y=foo($x,$m,$b,$t,$c);

echo $y;

