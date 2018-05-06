<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 05.05.2018
 * Time: 17:03
 */

const NumberOfBites = 200;
//Return array c
function encr($message, $n, $y)
{
    for ($i = 0; $i < strlen($message); $i++) {
        $x = gmp_random_range(1, gmp_sub($n, 1));
        if ($message[$i] == 0) {
            $c[$i] = gmp_powm($x, 2, $n);
        } else {
            $c[$i] = gmp_mod(gmp_mul($y, gmp_powm($x, 2, $n)), $n);
        }
    }
    return $c;
}

//Return Array m
function decr($c, $p)
{

    for ($i = 0; $i < count($c); $i++) {
        if (gmp_legendre($c[$i], $p) == 1) {
            $m[$i] = 0;
        } else $m[$i] = 1;
    }
    $m = implode($m);
    return $m;
}


function textBinASCII($text)
{
    $bin = array();
    for ($i = 0; strlen($text) > $i; $i++)
        $bin[] = decbin(ord($text[$i]));
    return $bin;
}

function ASCIIBinText($bin)
{
    $text = chr(bindec($bin));
    return $text;
}

//Return y
function generateQuadrNevichet($n)
{
    $k = 0;
    while ($k == 0) {
        $y = gmp_mod(gmp_random_bits(NumberOfBites), $n);
        if (gmp_jacobi($y, $n) == -1) $k = 1;
    }
    return $y;
}

//Return n and q in array
function generateSostavn()
{
    $p = gmp_nextprime(gmp_random_bits(NumberOfBites));
    $q = gmp_nextprime($p);
    $n = gmp_mul($p, $q);
    return [$n, $p];
}


$message = 'kak dela?';
echo "Alisa: " . $message . "\n";
$byteMessage = textBinASCII($message);

$n_p = generateSostavn();
$n = $n_p[0];
$p = $n_p[1];
$y = generateQuadrNevichet($n);
$finish = "";
foreach ($byteMessage as $message) {
    $encrypt = encr($message, $n, $y);
    $decrypt = decr($encrypt, $p);
    $finish = $finish . ASCIIBinText($decrypt);
}
echo "Bob: " . $finish;


