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

    // 1. Definirajte varijablu users i dodjelite joj niz koji sadržava podatke za dva korisnika. Svaki korisnik mora

$users = [
    [
        'ime'=>'Pero',
        'prezime'=>'Perić',
        'godine'=>26,
        'spol'=>'M'
    ],
    [
        'ime'=>'Marta',
        'prezime'=>'Martić',
        'godine'=>26,
        'spol'=>'Ž'
    ]
];
// 2. Ispišite cijeli niz
var_dump($users);

//3. U nizu svakom korisniku izbrišite ključ spol i njegovu vrijednost te ponovo ispišite cijeli niz.
unset($users[0]['spol']);
unset($users[1]['spol']); 
var_dump($users);

//4. Dodajte novog korisnika na kraj niza bez ključa spol.
$users[] = ['ime'=>'Ivan',
'prezime'=>'Ivić',
'godine'=>34];

// 5. Ponovo ispišite cijeli niz.
var_dump($users);

    ?>    
</body>
</html>