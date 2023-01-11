<?php
//1.Kreirajte kolačić i u njega zapišite neki podatak 
//( npr. adresu e-pošte).

setcookie('email', 'test@test.hr');

//2. Ispišite podatak iz kolačića.
var_dump($_COOKIE);

//3.Obrišite kolačić.
//Vrijeme u prošlost

setcookie('email', 'test@test.hr', -3660);
var_dump($_COOKIE);
