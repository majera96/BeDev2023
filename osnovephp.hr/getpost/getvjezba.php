<?php

//1. Pomoću varijable GET dohvatitie i ispišite podatke poslane kroz URL.
//2. Ako podaci ne postoje, ispišite poruku.
$pojam = isset($_GET['pojam']) ? $_GET['pojam'] : '';
if($_GET['pojam']){
    echo $pojam;
} else {
    echo 'Nema podataka';
}

