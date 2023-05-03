<?php

class PredavacController extends AutorizacijaController
{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'predavaci' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';

    public function index()
    {

        $lista = Predavac::read();
        foreach($lista as $p){
            if(file_exists(BP . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
            . 'predavaci' . DIRECTORY_SEPARATOR . $p->sifra . '.jpg' )){
                $p->slika= App::config('url') . 'public/img/predavaci/' . $p->sifra . '.jpg';
            }else{
                $p->slika= App::config('url') . 'public/img/nepoznato.jpg';
            }
        }

        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>$lista
        ]);
    }

    public function novi()
    {
        $noviPredavac = Predavac::create([
            'ime'=>'',
            'prezime'=>'',
            'email'=>'',
            'oib'=>'',
            'iban'=>''
        ]);
        header('location: ' . App::config('url') 
                . 'predavac/promjena/' . $noviPredavac);
    }
    
    public function promjena($sifra)
    {
        if(!isset($_POST['ime'])){

            $e = Predavac::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'predavac');
            }

            if(file_exists(BP . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
            . 'predavaci' . DIRECTORY_SEPARATOR . $sifra . '.jpg' )){
                $e->slika= App::config('url') . 'public/img/predavaci/' . $sifra . '.jpg';
            }else{
                $e->slika= App::config('url') . 'public/img/nepoznato.jpg';
            }

            $this->view->render($this->phtmlDir . 'detalji',[
                'e' => $e,
                'poruka' => 'Unesite podatke'
            ]);
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
       
    
        if($this->kontrola()){
            Predavac::update((array)$this->entitet);

            if(isset($_FILES['slika'])){
                move_uploaded_file($_FILES['slika']['tmp_name'], 
                BP . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
                 . 'predavaci' . DIRECTORY_SEPARATOR . $sifra . '.jpg');
            }


            header('location: ' . App::config('url') . 'predavac');
            return;
        }



        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrola()
    {
        return $this->kontrolaIme() && $this->kontrolaPrezime()
        && $this->kontrolaOib();
    }

    private function kontrolaIme()
    {
        if(strlen($this->entitet->ime)===0){
            $this->poruka = 'Ime obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaPrezime()
    {
        if(strlen($this->entitet->prezime)===0){
            $this->poruka = 'Prezime obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaOib(){
     //isto ko kod polaznika
        return true;
    }

    public function brisanje($sifra)
    {
        Predavac::delete($sifra);
        header('location: ' . App::config('url') . 'predavac');
    }

   /* public function testinsert()
    {
        for($i=0;$i<10;$i++){
            echo Predavac::create([
                'ime'=>'Pero ' . $i,
                'prezime'=>'Perić',
                'email'=>'',
                'oib'=>'',
                'iban'=>''
            ]);
        }
        
    } */
   

}