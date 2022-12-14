<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// 1. Definirajte varijablu $primeNumbers i dodjelite joj niz koji sadržava prvih pet primarnih brojeva.
$primeNumbers = [2,3,5,7,11];
// 2. Provjerite postoji li u nizu treći element, te pomoću funkcije var_dump() 
//ispišite rezultat provjere.Ako je rezultat provjere true, ispišite vrijednost trećeg elementa,a 
// ako je false ispišite da treći elemet u nizu ne postoji.

var_dump(in_array(2,$primeNumbers));
if(isset($primeNumbers[2])){
    echo $primeNumbers[2];
} else {
    echo 'Ne postoji treći element';
}

echo '<hr />';
// 3. Na kraju niza dodajte novu vrijednost, tj. šesti primarni broj.
array_push($primeNumbers, 13);
var_dump($primeNumbers);

echo '<hr />';
// 4. Zbrojite i ispišite broj elemenata u nizu
var_dump(count($primeNumbers));
echo '<hr />';
echo 'Zbroj niza je ' . array_sum($primeNumbers);
echo '<hr />';
// Sortitajte niz silazno po vrijednostima, te ponovo ispišite cijeli niz.
rsort($primeNumbers);
var_dump($primeNumbers);

?>
    
</body>
</html>