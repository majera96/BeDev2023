<?php

class GrupaController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'grupe' .
        DIRECTORY_SEPARATOR;

    private $entitet;
    private $poruka;

    public function index()
    {

        $grupe = Grupa::read();
        foreach($grupe as $g){
            if($g->datumpocetka!=null && 
                $g->datumpocetka!='0000-00-00 00:00:00'){
                $g->datumpocetka=date('d.m.Y.',
                strtotime($g->datumpocetka));
            }else{
                $g->datumpocetka='Nije postavljeno';
            }
        }

        $this->view->render($this->phtmlDir . 'index',[
            'entiteti' => $grupe
        ]);
    }

    public function nova()
    {
        $novi = Grupa::create([
            'naziv'=>'',
            'smjer'=>1,
            'predavac'=>null,
            'datumpocetka'=>'',
            'maksimalnopolaznika'=>'20'
        ]);
        header('location: ' . App::config('url') 
                . 'grupa/promjena/' . $novi);
    }

    public function promjena($sifra)
    {
        $smjerovi=$this->ucitajSmjerove();
        $predavaci = $this->ucitajPredavace();

        if(!isset($_POST['naziv'])){

            $e = Grupa::readOne($sifra);
            //Log::log($e);
            if($e->datumpocetka!=null){
                $e->datumpocetka = date('Y-m-d',
                strtotime($e->datumpocetka));
            }else{
                $e->datumpocetka = '';
            }
            if($e==null){
                header('location: ' . App::config('url') . 'grupa');
            }
           
            $this->detalji($e,$smjerovi,$predavaci,'Unesite podatke');
           
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
        
    
        
        if($this->kontrola()){
            if($this->entitet->predavac==0){
                $this->entitet->predavac=null;
            }
            if($this->entitet->datumpocetka==''){
                $this->entitet->datumpocetka=null;
            }

            Grupa::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'grupa');
            return;
        }
        
        $this->detalji($this->entitet,$smjerovi,$predavaci,$this->poruka);
 
    }

    private function detalji($e,$smjerovi,$predavaci,$poruka)
    {
        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$e,
            'smjerovi'=>$smjerovi,
            'predavaci'=>$predavaci,
            'poruka'=>$poruka,
            'css'=>'<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">',
            'js'=>'<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
            <script>
                let url=\'' .  App::config('url') .  '\';
                let grupa=' . $e->sifra . ';
            </script>
            <script src="'. App::config('url') . 'public/js/detaljiGrupe.js"></script>
            '
        ]);
    }

    private function ucitajSmjerove()
    {
        $smjerovi = [];
        $s = new stdClass();
        $s->sifra=0;
        $s->naziv='Odaberi smjer';
        $smjerovi[]=$s;
        foreach(Smjer::read() as $smjer){
            $smjerovi[]=$smjer;
        }
        return $smjerovi;
    }

    private function ucitajPredavace()
    {
        $lista = [];
        $s = new stdClass();
        $s->sifra=0;
        $s->prezime='Odaberi';
        $s->ime = 'Predavača';
        $lista[]=$s;
        foreach(Predavac::read() as $p){
            $lista[]=$p;
        }
        return $lista;
    }

    private function kontrola()
    {
        return $this->kontrolaSmjer();
    }

    private function kontrolaSmjer(){
        if($this->entitet->smjer==0){
            $this->poruka='Obavezno smjer';
            return false;
        }
        return true;
    }

    public function brisanje($sifra)
    {
        Grupa::delete($sifra);
        header('location: ' . App::config('url') . 'grupa');
    }

    public function dodajpolaznik()
    {
        if(!isset($_GET['grupa']) || !isset($_GET['polaznik'])){
            return;
        }
        Grupa::dodajpolaznik($_GET['grupa'],$_GET['polaznik']);
    }

    public function obrisipolaznik()
    {
        if(!isset($_GET['grupa']) || !isset($_GET['polaznik'])){
            return;
        }
        Grupa::obrisipolaznik($_GET['grupa'],$_GET['polaznik']);
    }
}