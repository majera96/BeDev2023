<?php

//1. Pokrenite sesiju i u nju zapišite neki podatak (npr. adresu e-pošte).
session_start();
//2. Ispišite podatak iz sesije.
$_SESSION['email'] = 'test@test.hr';
var_dump($_SESSION['email']);
//3. Zatvorite sesiju.
session_destroy();
//4. Ponovo ispišite podatke iz sesije.
var_dump($_SESSION);
