<?php

class Grupa
{


    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           select * from grupa where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $grupa = $izraz->fetch();
        if($grupa->datumpocetka=='0000-00-00 00:00:00'){
            $grupa->datumpocetka=null;
        }
        $izraz = $veza->prepare('
        
           select a.sifra, b.ime, b.prezime 
           from polaznik a inner join osoba b
           on a.osoba=b.sifra inner join clan c
           on c.polaznik=a.sifra where c.grupa=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $grupa->polaznici = $izraz->fetchAll();

        return $grupa;
    }

    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select a.sifra, b.naziv as smjer,
            concat(d.prezime, \' \', d.ime) as predavac,
            a.naziv, a.datumpocetka, a.maksimalnopolaznika,
            count(e.polaznik) as polaznika
            from grupa a 
            inner join smjer b on a.smjer=b.sifra
            left join predavac c on a.predavac =c.sifra 
            left join osoba d on c.osoba =d.sifra 
            left join clan e on a.sifra=e.grupa 
            group by a.sifra, b.naziv ,
            concat(d.prezime, \' \', d.ime) ,
            a.naziv, a.datumpocetka, a.maksimalnopolaznika
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($p)
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        insert into grupa
            (naziv,datumpocetka,maksimalnopolaznika,
            smjer,predavac)
            values
            (:naziv,:datumpocetka,:maksimalnopolaznika,
            :smjer,:predavac);
        
        ');
        $izraz->execute($p);
        return $veza->lastInsertId();
    }

    public static function update($p)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        update grupa set
            naziv=:naziv,
            datumpocetka=:datumpocetka,
            maksimalnopolaznika=:maksimalnopolaznika,
            smjer=:smjer,
            predavac=:predavac
        where sifra=:sifra;
        
        ');
        $izraz->execute($p);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           delete from grupa where sifra=:sifra 
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        
    }

    public static function dodajpolaznik($grupa,$polaznik)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           insert into clan(grupa,polaznik) values
           (:grupa,:polaznik)
        
        ');
        $izraz->execute([
            'grupa'=>$grupa,
            'polaznik'=>$polaznik
        ]);
    }

    public static function obrisipolaznik($grupa,$polaznik)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
          delete from clan where grupa=:grupa 
          and polaznik=:polaznik
        
        ');
        $izraz->execute([
            'grupa'=>$grupa,
            'polaznik'=>$polaznik
        ]);
    }

}