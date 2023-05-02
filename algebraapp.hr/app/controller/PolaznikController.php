<?php

class PolaznikController extends AutorizacijaController
{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'polaznici' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>Polaznik::read()
        ]);
    }

    public function novi()
    {
        $noviPolaznik = Polaznik::create([
            'ime'=>'',
            'prezime'=>'',
            'email'=>'',
            'oib'=>'',
            'brojugovora'=>''
        ]);
        header('location: ' . App::config('url') 
                . 'polaznik/promjena/' . $noviPolaznik);
    }
    
    public function promjena($sifra)
    {
        if(!isset($_POST['ime'])){

            $e = Polaznik::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'polaznik');
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
            Polaznik::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'polaznik');
            return;
        }

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrola()
    {
        $this->poruka = 'Nešto nije u redu';
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
            //nemam vremena trenutno
        return true;
    }

    public function brisanje($sifra)
    {
        Polaznik::delete($sifra);
        header('location: ' . App::config('url') . 'polaznik');
    }

    public function trazi()
    {
        if(!isset($_GET['term'])){
            return;
        }
        echo json_encode(Polaznik::search($_GET['term'],$_GET['grupa']));
    }

   /* public function testinsert()
    {
        for($i=0;$i<10;$i++){
            echo Polaznik::create([
                'ime'=>'Pero ' . $i,
                'prezime'=>'Perić',
                'email'=>'',
                'oib'=>'',
                'brojugovora'=>''
            ]);
        } */
        
    } 
   