<?php

class PolaznikController extends AutorizacijaController
{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'polaznici' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';
    private $pozicija='ime';

    public function index()
    {

        if(!isset($_GET['stranica'])){
            $stranica=1;
        }else{
            $stranica=(int)$_GET['stranica'];
        }
        

        if(!isset($_GET['uvjet'])){
            $uvjet='';
        }else{
            $uvjet=$_GET['uvjet'];
        }


        $up = Polaznik::ukupnoPolaznika($uvjet);
        $ukupnoStranica = ceil($up / App::config('rps'));
        
        if($stranica>$ukupnoStranica){
            $stranica = 1;
        }

        if($stranica==0){
            $stranica=$ukupnoStranica;
        }




        $lista = Polaznik::read($stranica, $uvjet);

        foreach($lista as $p){
            if(file_exists(BP . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
            . 'polaznici' . DIRECTORY_SEPARATOR . $p->sifra . '.png' )){
                $p->slika= App::config('url') . 'public/img/polaznici/' . $p->sifra . '.png';
            }else{
                $p->slika= App::config('url') . 'public/img/nepoznato.jpg';
            }
        }


        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>$lista,
            'uvjet'=>$uvjet,
            'stranica' => $stranica,
            'ukupnoStranica'=>$ukupnoStranica,
            'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/cropper.css">',
            'js'=>'<script>
            let url=\'' . App::config('url') . '\';
            </script>
            <script src="' . App::config('url') . 'public/js/vendor/cropper.js"></script>
            <script src="' . App::config('url') . 'public/js/indexPolaznik.js"></script>'
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

            $this->pozoviDetalji($e);
            return;
        }

        
        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
    
        $this->poruka = 'Nešto nije u redu';

        try{
            $this->kontrolaIme();
            $this->kontrolaPrezime();
            $this->kontrolaOib();
            Polaznik::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'polaznik');
            return;
        }catch(Exception $e){
            $this->poruka= $e->getMessage();
            $this->pozoviDetalji($this->entitet);
        }
       
    }

    private function pozoviDetalji($entitet){
        $this->view->render($this->phtmlDir . 'detalji',[
            'e' => $entitet,
            'poruka' => 'Unesite podatke',
            'pozicija'=>$this->pozicija,
            'js'=>'
            <script>
        let pozicija=\'' . $this->pozicija . '\';
        </script>
            <script src="' . App::config('url') . 'public/js/detaljiPolaznik.js"></script>'
        ]);
    }

    private function kontrolaIme()
    {
        if(strlen($this->entitet->ime)===0){
            $this->pozicija='ime';
            throw new Exception('Ime obavezno');
        }
        
    }

    private function kontrolaPrezime()
    {
        if(strlen($this->entitet->prezime)===0){
            $this->pozicija='prezime';
            throw new Exception('Prezime obavezno');
        }
    }

    private function kontrolaOib(){
      //nemam vremena
    }

    public function brisanje($sifra)
    {
            Polaznik::delete($sifra);
            $uvjet = isset($_GET['uvjet']) ? $_GET['uvjet'] : '';
            $stranica = isset($_GET['stranica']) ? $_GET['stranica'] : '';
            header('location: ' . App::config('url') . 'polaznik?uvjet=' . $uvjet . '&stranica=' . $stranica);
    }

    public function trazi()
    {
        if(!isset($_GET['term'])){
            return;
        }
        echo json_encode(Polaznik::search($_GET['term'],$_GET['grupa']));
    }


    public function spremisliku(){

        $slika = $_POST['slika'];
        $slika=str_replace('data:image/png;base64,','',$slika);
        $slika=str_replace(' ','+',$slika);
        $data=base64_decode($slika);

        file_put_contents(BP . 'public' . DIRECTORY_SEPARATOR
        . 'img' . DIRECTORY_SEPARATOR . 
        'polaznici' . DIRECTORY_SEPARATOR 
        . $_POST['id'] . '.png', $data);

        echo "OK";
    }

    public function mozebrisati($sifra){
        if(Polaznik::mozeBrisati($sifra)){
            echo 'DA';
        }else{
            echo 'NE';
        }
    }

    /*public function testinsert()
    {
        for($i=0;$i<1000;$i++){
            echo Polaznik::create([
                'ime'=>'Pero ' . $i,
                'prezime'=>'Perić',
                'email'=>'',
                'oib'=>'',
                'brojugovora'=>''
            ]);
        }
        
    } */
   
}