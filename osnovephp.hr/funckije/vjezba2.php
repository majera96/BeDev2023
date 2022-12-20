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

    //Proizvoljno deklarirajte funkciju koja ima dva argumenta(name i surname). Funkcija treba
    //konkatenirati podatke iz argumenata tako da između postoji razmak i dodjeliti ih lokalnoj
    //varijabli, zatim treba vrijednost u varijabli pretvoriti u velika slova i to vratiti kao rezultat.
 
    function getNameAndSurname($name,$surname)
 {
    $nameAndSurname = $name . ' ' . $surname;
    $nameAndSurname = strtoupper($nameAndSurname);
    return $nameAndSurname;
 }

 //Pozovite funkciju i vraćebnu vrijednost dodjelite varijabli.

 $text = getNameAndSurname('Antonio','Majer');

 //Ispišite vrijednost varijable.

 echo $text, '<br />';

    ?>
</body>
</html>