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
    //1. Koristeći uvjetovani tip kontrolne strukture switch ispišite koji je trenutno dan u tjednu.
    //2. Za ispravno izvršenu vježbu koristite PHP funkciju date(). Nazivi dana moraju biti na hrvatskom jeziku.
    $dan = date("D");
    switch ($dan) {
        case 'Mon':
            echo 'Danas je ponedjeljak';
            break;
        case 'Tue':
            echo 'Danas je utorak';
            break;
        case 'Wed':
            echo 'Danas je srijeda';
            break;
        case 'Thu':
            echo 'Danas je četvrtak';
            break;
        case 'Fri':
            echo 'Danas je petak';
            break;
        case 'Sat':
            echo 'Danas je subota!';
            break;
        case 'Sun':
            echo 'Danas je nedjelja';
            break;
        default:
            echo 'Ne postoji ovaj dan';
    }
    ?>
</body>
</html>