<?php

class Polaznik
{

    public static function mozeBrisati($sifra){
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select count(*)
            from clan
            where polaznik = :sifra
      
        
        '); 
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $ukupno = $izraz->fetchColumn();
        return $ukupno==0;
    }

    public static function ukupnoPolaznika($uvjet)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select count(a.sifra)
            from polaznik a 
            inner join osoba b on a.osoba = b.sifra 
            where concat(b.ime, \' \', b.prezime, \' \', ifnull(b.oib,\'\')) like :uvjet
      
        
        '); 
        $uvjet = '%' . $uvjet . '%';
        $izraz->bindParam('uvjet',$uvjet);
        $izraz->execute();
        return $izraz->fetchColumn();
    }

    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select a.sifra, a.brojugovora,
        b.ime, b.prezime, b.email, b.oib from 
        polaznik a inner join
        osoba b on a.osoba =b.sifra 
        where a.sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        return $izraz->fetch(); 
    }

    // CRUD - R
    public static function read($stranica, $uvjet)
    {

        $rps = App::config('rps');
        $od = $stranica * $rps - $rps;


        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select a.sifra, b.ime, b.prezime, b.email, b.oib, a.brojugovora, 
        count(c.grupa) as grupa
        from polaznik a 
        inner join osoba b on a.osoba = b.sifra 
        left join clan c on a.sifra =c.polaznik 
        where concat(b.ime, \' \', b.prezime, \' \', ifnull(b.oib,\'\')) 
                like :uvjet
        group by 
        a.sifra, b.ime, b.prezime, b.email, b.oib, a.brojugovora
        order by 3, 2
        limit :od, :rps
        
        ');
        $uvjet = '%' . $uvjet . '%';
        $izraz->bindValue('od',$od,PDO::PARAM_INT);
        $izraz->bindValue('rps',$rps,PDO::PARAM_INT);
        $izraz->bindParam('uvjet',$uvjet);
        $izraz->execute();
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }

    // CRUD - C
    public static function create($p) //$p kao parametri - napisano skraćeno
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
            insert into osoba (ime,prezime,email,oib)
            values (:ime,:prezime,:email,:oib);
        ');
        $izraz->execute([
            'ime'=>$p['ime'],
            'prezime'=>$p['prezime'],
            'email'=>$p['email'],
            'oib'=>$p['oib']
        ]);
        $sifraOsoba = $veza->lastInsertId();
        $izraz = $veza->prepare('
            insert into polaznik (osoba,brojugovora)
            values (:osoba,:brojugovora);
        ');
        $izraz->execute([
            'osoba'=>$sifraOsoba,
            'brojugovora'=>$p['brojugovora']
        ]);
        $sifraPolaznik = $veza->lastInsertId();
        $veza->commit();
        return $sifraPolaznik;
    }

    // CRUD - U
    public static function update($p)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();

        $izraz = $veza->prepare('
        
           select osoba from polaznik where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$p['sifra']
        ]);
        $sifraOsoba = $izraz->fetchColumn();

        $izraz = $veza->prepare('
            update osoba set
            ime=:ime,
            prezime=:prezime,
            email=:email,
            oib=:oib
            where sifra=:sifra
        ');
        $izraz->execute([
            'ime'=>$p['ime'],
            'prezime'=>$p['prezime'],
            'email'=>$p['email'],
            'oib'=>$p['oib'],
            'sifra'=>$sifraOsoba
        ]);

        $izraz = $veza->prepare('
            update polaznik set
            brojugovora=:brojugovora
            where sifra=:sifra
        ');
        $izraz->execute([
            'brojugovora'=>$p['brojugovora'],
            'sifra'=>$p['sifra']
        ]);


        $veza->commit();

    }

     // CRUD - D
    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();

        $izraz = $veza->prepare('
        
           select osoba from polaznik where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $sifraOsoba = $izraz->fetchColumn();

        $izraz = $veza->prepare('
            delete from polaznik where sifra=:sifra
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);

        $izraz = $veza->prepare('
            delete from osoba where sifra=:sifra
        ');
        $izraz->execute([
            'sifra'=>$sifraOsoba
        ]);


        $veza->commit();
    }



    public static function search($uvjet, $grupa)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
            select a.sifra, a.brojugovora,
            b.ime, b.prezime, b.email, 
            b.oib from 
            polaznik a inner join
            osoba b on a.osoba =b.sifra 
            where concat(b.ime,\' \', b.prezime) like :uvjet
            and a.sifra not in (select polaznik from clan where
            grupa=:grupa)
            order by 4,3
            limit 10
        ');
        $izraz->execute([
            'uvjet' => '%' . $uvjet . '%',
            'grupa' => $grupa
        ]); 
        return $izraz->fetchAll(); 
    }
}