<?php

echo 'Zadatak broj 1';
echo '<br />';

$a = 10;
$b = 5;
$c = 'String1';
$d = 'String2';

echo 'Zadatak broj 2';
echo '<br />';

$rez = $a + $b;
echo $rez,'<br />';
$rez = $a - $b;
echo $rez, '<br />';
$rez = $a * $b;
echo $rez, '<br />';
$rez = $a / $b;
echo $rez, '<br />';
$rez = $a % $b;
echo $rez, '<br />';

echo 'Zadatak broj 3';
echo '<br />';

$f = $c . 'Dobar string' . $d . 'Još bolji';
echo $f, '<br />';

echo 'Zadatak broj 4';
echo '<br />';

$a = $a + $b;
echo $a, '<br />';

$rez = $a < $b;
var_dump($rez);
echo '<br />';

echo 'Zadatak broj 5';
echo '<br />';

echo ++$a, '<br />';
echo $a--, '<br />';
