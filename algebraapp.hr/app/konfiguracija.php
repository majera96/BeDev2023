<?php

$dev=$_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
    return [
        'dev'=>$dev,
        'url'=>'http://algebraapp.hr/',
        'nazivApp'=>'DEV Algebra App',
        'rps'=>6,
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
        'rps'=>12,
        'baza'=>[
            'server'=>'',
            'baza'=>'',
            'korisnik'=>'',
            'lozinka'=>''
        ]
    ];
}

