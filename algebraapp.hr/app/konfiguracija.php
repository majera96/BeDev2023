<?php

$dev=$_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
    return [
        'dev'=>$dev,
        'url'=>'http://algebraapp.hr/',
        'nazivApp'=>'DEV Algebra App',
        'baza'=>[
            'server'=>'localhost',
            'baza'=>'algebraapp',
            'korisnik'=>'algebra',
            'lozinka'=>'algebra'
        ]
    ];
}else{
    // PRODUKCIJA KOJE NEMA TRENUTNO
    return [
        'dev'=>$dev,
        'url'=>'',
        'nazivApp'=>'',
        'baza'=>[
            'server'=>'',
            'baza'=>'',
            'korisnik'=>'',
            'lozinka'=>''
        ]
    ];
}

