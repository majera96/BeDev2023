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
// Proizvoljno deklarirajte funkciju koja vraća neki tekst.
function vracamTekstZaVjezbu()
{
    echo 'Probni tekst kroz funkciju', '<br />';
}

vracamTekstZaVjezbu();

// Pozovite funkciju i vraćenu vrijednost dodijelite varijabli.

$x = vracamTekstZaVjezbu();

// Ispišite vrijednost varijable.
echo $x;

// Proširite zadatak tako da u niz spremite
// nekakav random string, te ga kroz petlju ispišete.

function vracamStringKrozPetlju()
{
    for($i = 0; $i <=10; $i++){
        echo 'Ponovljeni string', '<br />';
    }
}

vracamStringKrozPetlju();


?>
</body>
</html>
