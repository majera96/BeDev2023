<?php

//2. Kreirajte datoteku "obrada.php" i unutar nje dohvatite podatke iz
//obrasca i obradite ih na sljedeći način:
 // 1- Provjerite postoji li podaci,ako ih nema,
 //   ispišite poruku da nema podataka za obradu
 // 2-Provjerite pojedinačne podatke i ako postoje, ispišite ih,
 // a ako podaci ne postoje, ispišite poruku da ih nema. 

if (empty($_POST['ime'] && $_POST['prezime'])){
    echo 'Nema podataka';
} else {
    echo 'Pozdrav' . $_POST['ime'] . ' ' . $_POST['prezime'];
}