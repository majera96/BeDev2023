<?php

class SmjerController extends AutorizacijaController
{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'smjerovi' .
        DIRECTORY_SEPARATOR;

    private $smjer=null;
    private $poruka='';

    public function index()
    {
        $nf = new NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        $nf->setPattern('#,##0.00');
        $smjerovi = Smjer::read();
        foreach($smjerovi as $s){
            $s->cijena = $nf->format($s->cijena);
            $s->upisnina = $nf->format((float)$s->upisnina);
        }

        $this->view->render($this->phtmlDir . 'read',[
            'smjerovi' => $smjerovi
        ]);
    }

    public function promjena($sifra)
    {
        if(!isset($_POST['naziv'])){

            $smjer = Smjer::readOne($sifra);
            if($smjer==null){
                header('location: ' . App::config('url') . 'smjer');
            }

            $this->view->render($this->phtmlDir . 'update',[
                'smjer' => $smjer,
                'poruka' => 'Promjenite podatke'
            ]);
            return;
        }

        $this->smjer = (object) $_POST;
        $this->smjer->sifra=$sifra;
        $this->smjer->certificiran = isset($_POST['certificiran']);

        if($this->kontrolaPromjena()){
            Smjer::update((array)$this->smjer);
            header('location: ' . App::config('url') . 'smjer');
            return;
        }

        $this->view->render($this->phtmlDir . 'update',[
            'smjer'=>$this->smjer,
            'poruka'=>$this->poruka
        ]);


    }

    public function brisanje($sifra)
    {

        $smjer = Smjer::readOne($sifra);
        if($smjer==null){
            header('location: ' . App::config('url') . 'smjer');
        }

        if(!isset($_POST['obrisi'])){
            $this->view->render($this->phtmlDir . 'delete',[
                'smjer' => $smjer,
                'brisanje'=>Smjer::brisanje($sifra),
                'poruka' => 'Detalji smjera za brisanje'
            ]);
            return;
        }

        Smjer::delete($sifra);
        header('location: ' . App::config('url') . 'smjer');
        

    }

    public function novi()
    {
        if(!isset($_POST['naziv'])){
            $this->pripremiSmjer();
            $this->view->render($this->phtmlDir . 'create',[
                'smjer'=>$this->smjer,
                'poruka'=>'Popunite sve podatke'
            ]);
            return; 
        }
         
        $this->smjer = (object) $_POST;
        $this->smjer->certificiran = isset($_POST['certificiran']);
    
        if($this->kontrolaNovi()){
            Smjer::create((array)$this->smjer);
            header('location: ' . App::config('url') . 'smjer');
            return;
        }

        $this->view->render($this->phtmlDir . 'create',[
            'smjer'=>$this->smjer,
            'poruka'=>$this->poruka
        ]);
        
    }

    private function kontrolaNovi()
    {
        return $this->kontrolaNaziv() && $this->kontrolaCijena();
    }

    private function kontrolaPromjena()
    {
        return $this->kontrolaNaziv();
    }

    private function kontrolaNaziv()
    {
        $this->smjer->naziv=str_replace('&nbsp;',' ',$this->smjer->naziv);
        $this->smjer->naziv=trim($this->smjer->naziv);
        if(strlen($this->smjer->naziv)===0){
            $this->poruka = 'Naziv obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaCijena()
    {
        $broj = (float)$this->smjer->cijena;
        if($broj<=0){
            $this->poruka='Cijena mora biti broj veći od nule (0)';
            $this->smjer->cijena=0;
            return false;
        }
        return true;
    }
    

    private function pripremiSmjer()
    {
        $this->smjer=new stdClass();
        $this->smjer->naziv='';
        $this->smjer->cijena='';
        $this->smjer->trajanje='';
        $this->smjer->upisnina='';
        $this->smjer->certificiran=false;
    }

}