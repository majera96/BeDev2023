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
//1. Definirajte varijablu names i dodjelite joj niz koji sadrži pet imena.
$names = [
    'ime broj 1' => 'Antonio',
    'ime broj 2' => 'Ivan',
    'ime broj 3' => 'Marko',
    'ime broj 4' => 'Matej',
    'ime broj 5' => 'Pero'
        ];

//2. Koristeći petlju foreach, iz niza ispišite ključeve i pripadajuće im vrijednosti.
foreach($names as $imebroj => $ime){
    echo "$imebroj je $ime", '<br />';
}

?>
    
</body>
</html>