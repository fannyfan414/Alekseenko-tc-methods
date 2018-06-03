<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 05.05.2018
 * Time: 17:03
 */

const NumberOfBites = 2500; //for p and q. N=2*NumberOfBites
const LengthOfText = 100; //Length of text = 50*LengthOfText

//Return array
function encr($message, $n, $y)
{
    $c = array();
    for ($i = 0; $i < strlen($message); $i++) {
        $x = gmp_random_range(2, gmp_sub($n, 1));
        if ($message[$i] == 0) {
            $c[$i] = gmp_powm($x, gmp_init(2), $n);
        } else {
            $c[$i] = gmp_mod(gmp_mul($y, gmp_powm($x, 2, $n)), $n);
        }
    }
    return $c;
}

//Return array
function decr($c, $p)
{
    $m = array();
    for ($i = 0; $i < count($c); $i++) {
        if (gmp_powm($c[$i], gmp_div(gmp_sub($p, 1), 2), $p) == 1) {
            $m[$i] = 0;
        } else {
            $m[$i] = 1;
        }
    }
    $m = implode($m);
    return $m;
}

//Return array
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
function generateQuadrNevichet($n, $p, $q)
{
    while (true) {
        $y = gmp_mod(gmp_random_bits(NumberOfBites), $n);
        if (gmp_legendre($y, $p) == -1 && gmp_legendre($y, $q) == -1) break;
    }
    return $y;
}

//Return [n,p,q]
function generateSostavn()
{
    $p = gmp_nextprime(gmp_random_bits(NumberOfBites));
    $q = gmp_nextprime($p);
    $n = gmp_mul($p, $q);
    return [$n, $p, $q];
}

function generateRandomText($length)
{
    return str_shuffle(str_repeat(" abcdefghijklmnopqrstuvwxyABDEFGHIJKLMNOPQRSTUVWXY", $length));
}

$message = generateRandomText(LengthOfText);
echo "Alisa: " . $message . "\n";

$byteMessage = textBinASCII($message);

$arrayOfNPQ = generateSostavn();
$n = $arrayOfNPQ[0];
$p = $arrayOfNPQ[1];
$q = $arrayOfNPQ[2];

$y = generateQuadrNevichet($n, $p, $q);

$finish = "";

$time_start = microtime(true);

foreach ($byteMessage as $message) {
    $encrypt = encr($message, $n, $y);
    $decrypt = decr($encrypt, $p);
    $finish = $finish . ASCIIBinText($decrypt);
}
echo "Bob:   " . $finish;
echo "\nДлина текста: " . strlen($finish);
echo "\nTotal execution time in seconds: " . (microtime(true) - $time_start);




