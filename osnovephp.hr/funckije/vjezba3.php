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

    //1.Proizvoljno deklarirajte funkciju koja ima jedan argument (number).
    // Funkcija treba imate lokalnu varijablu u koju će pribrojiti vrijednost argumenta number te istu vratiti
    //kao rezultat. Vrijednost treba biti zadržana kod svakog poziva funkcije.
    
    function localFunc($number)
    {
    static $a = 0;
    $a += $number;
    
    return $a;
    } 
    
    //2.Deklarirajte funkciju kao varijablu.

    $var = 'addNumber';

    //3. Pozovite funkciju pomoću varijable,a kao vrijednost argumenta pošaljite slučajan broj
    //u rasponu od 1 do 1o te ispišite rezultat.

    echo $var(rand(1,10)), '<br />';

    //4. Ponovite postupak 5 puta.
    for ($i = 0; $i < 5; $i++) {
        echo $var(rand(1,10)), '<br />';
    } 
    ?>
    
</body>
</html>