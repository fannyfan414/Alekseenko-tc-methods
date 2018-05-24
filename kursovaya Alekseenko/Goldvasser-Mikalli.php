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
    $c = array();
    for ($i = 0; $i < strlen($message); $i++) {

        $k = 0;
        while ($k == 0) {
            $x = gmp_random_range(2, gmp_sub($n, 1));
            if (gmp_gcd($x, $n) == 1) $k = 1;
        }
        if ($message[$i] == 0) {
            $c[$i] = gmp_powm($x, gmp_init(2), $n);
        } else {
            $c[$i] = gmp_mod(gmp_mul($y, gmp_powm($x, 2,$n)), $n);
        }
    }
    return $c;
}

//Return Array m
function decr($c, $p)
{
    $m = array();
    for ($i = 0; $i < count($c); $i++) {
//        if (gmp_legendre($c[$i], $p) == 1) {
//            $m[$i] = 0;
//        } else {
//            $m[$i] = 1;
//        }

        if(gmp_powm($c[$i],gmp_div(gmp_sub($p,1),2),$p)==1){
            $m[$i]=0;
        }else{
            $m[$i]=1;
        }

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
        if (gmp_legendre($y, $n) == gmp_init(-1))    $k = 1;
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


$message = 'привет, как дела?';
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



