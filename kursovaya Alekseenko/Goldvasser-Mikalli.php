<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 05.05.2018
 * Time: 17:03
 */
function encr($message, $n, $y)
{
    for ($i = 0; $i <= strlen($message); $i++) {
        $x = rand(1, $n - 1);
        if ($message[$i] = 0) $c[$i] = gmp_powm($x, 2, $n);
        else $c[$i] = $y * gmp_powm($x, 2, $n);
    }
    return $c;
}

function decr($c, $p)
{
    for ($i = 0; $i < count($c); $i++) {
        if (gmp_legendre($c[$i], $p) == 1) $m[$i] = 0;
        if (gmp_legendre($c[$i], $p) == -1) $m[$i] = 1;
    }
    return $m;
}

function textBinASCII($text)
{
    $bin = array();
    for ($i = 0; strlen($text) > $i; $i++)
        $bin[] = decbin(ord($text[$i]));
//    return implode(' ',$bin);
    return $bin;
}

function ASCIIBinText($bin)
{
    $text = array();
//    $bin = explode(" ", $bin);
    for ($i = 0; count($bin) > $i; $i++)
        $text[] = chr(bindec($bin[$i]));

    return implode($text);
}

function generateQuadrNevichet($n)
{
    $k = 0;
    while ($k == 0) {
        $y = rand(2, pow(2, 10));
        if (gmp_legendre($y, $n) == 1) $k = 1;
    }
    return $y;
}

function generateSostavn(){
    $p=gmp_nextprime(rand(pow(2,40),pow(2,50)));
    $q=gmp_nextprime($p);
    $n=$p*$q;
    return [$n,$p];
}


$message='hello';
$byteMessage=textBinASCII($message);

$n_p=generateSostavn();
$n=$n_p[0];
$p=$n_p[1];
$y=generateQuadrNevichet($n);

$c=encr($message,$n,$y);
//$test = textBinASCII('da? huy na');
//$finish = ASCIIBinText($test);

