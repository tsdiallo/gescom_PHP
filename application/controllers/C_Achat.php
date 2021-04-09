<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Index Page for this controller.
 *
 * Maps to the following URL
 * 		http://example.com/index.php/welcome
 *	- or -
 * 		http://example.com/index.php/welcome/index
 *	- or -
 * Since this controller is set as the default controller in
 * config/routes.php, it's displayed at http://example.com/
 *
 * So any other public methods not prefixed with an underscore will
 * map to /index.php/welcome/<method_name>
 * @see https://codeigniter.com/user_guide/general/urls.html
 */

class C_Achat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Ouvrage", "ouv");
        $this->load->model("M_Exemplaire", "exe");
        $this->load->model("M_Editeur", "edit");
        $this->load->model("M_Commande", "com");
        $this->load->model("M_Detailcommande", "det");
    }   

    public function index()
    {

    }
    public function showNCommande()
    {
        $data['listeOuv'] = $this->ouv->findAll();
        $data['listeEdit'] = $this->edit->findAll();
        $data['listeExe'] = $this->exe->findAll();
        $data['listeCom'] = $this->com->findAll();
        $data['listeDet'] = $this->det->findAll();
        $this->load->view('achat/v_nouveau', $data);
    }
    public function showRCommande()
    {
        $data['listeOuv'] = $this->ouv->findAll();
        $data['listeEdit'] = $this->edit->findAll();
        $data['listeExe'] = $this->exe->findAll();
        $data['listeCom'] = $this->com->findAll();
        $data['listeDet'] = $this->det->findAll();
        $this->load->view('achat/v_renouveau', $data);
    }

    public function showEditOuv()
    {
        $data['listeOuv'] = $this->ouv->findAll();
        $data['listeEdit'] = $this->edit->findAll();
        $data['listeExe'] = $this->exe->findAll();
        $data['listeCom'] = $this->com->findAll();
        $data['listeDet'] = $this->det->findAll();
        $this->load->view('achat/v_editouv', $data);
    }
    
    public function showExemplaire()
    {
        $data['listeOuv'] = $this->ouv->findAll();
        $data['listeEdit'] = $this->edit->findAll();
        $data['listeExe'] = $this->exe->findAll();
        $data['listeCom'] = $this->com->findAll();
        $data['listeDet'] = $this->det->findAll();
        $this->load->view('achat/v_exemplaire', $data);
    }

    public function saveCommande()
	{
            $i=0;
			//enregistrement de la commande
            $this->com->numero=$this->input->post("numero");
            foreach ($listeCom as $key => $value) {
                if($this->com->numero == $value->numero){
                    $i=1;
                    break;
                }
            }
            if($i==0){
			$this->com->date=$this->input->post("date");
			$this->com->etat="Pas livree";
			$this->com->id_editeur=$this->input->post("id_edit");
			//json to array
            $details=json_decode($this->input->post("details"));
            if($this->com->id_editeur != 0){
			$d=$this->com->insert();
			if(!empty($d)&& $d['id']>0){
				foreach ($details as $value) {
					$this->det->qtecom=$value->qtecom;
					$this->det->id_commande=$d['id'];
					$this->det->id_ouvrage=$value->id;
					$this->det->qteliv=0;
                    $this->det->insert();			
				}
            }
            }else{

            }
            }else{

            }
            echo(json_encode($d));
    }
    
    public function saveExe()
	{
        $num=0;
        //json to array
        $detail=json_decode($this->input->post("detail"));
        foreach ($detail as $value) {
            $this->det->id=$value->id;
            $de=$this->det->findById();

            $this->det->id=$value->id;
            $this->det->id_ouvrage=$de->id_ouvrage;
            $this->det->id_commande=$de->id_commande;
            $this->det->qtecom=$de->qtecom;
            $this->det->qteliv=$value->qteliv;
            $this->det->update();
        }
        $details=json_decode($this->input->post("details"));
        foreach ($details as $value) {
            $code=bin2hex(random_bytes(3));
            $this->exe->valeur=$value->valeur;
            $this->exe->duree=$value->duree;
            $this->exe->id_ouvrage=$value->id_ouvrage;
            $this->exe->codeBarre= 'Exemplaire_'.$code;
            $this->exe->etat=$value->etat;
            $this->exe->id_remplace=$value->id_remplace;
            $this->exe->date=$value->date;
            $this->exe->insert();
            $num=$value->idcom;
        }
        $this->com->numero=$num;
        $d=$this->com->findByNumero();
        echo(json_encode($d));
    }

    public function updateCom(){
        $this->com->id=$this->input->post("id");
        $this->com->date=$this->input->post("date");
        $this->com->id_editeur=$this->input->post("id_editeur");
        $this->com->numero=$this->input->post("numero");
        $this->com->etat="Livrée";
        $d=$this->com->update();
        echo(json_encode($d));
    }

    
    public function saveRen()
    {
        //json to array
        $details=json_decode($this->input->post("details"));
        foreach ($details as $value) {
            $this->exe->id=$value->id1;
            $e=$this->exe->findById();

            $this->exe->id=$e->id;
            $this->exe->etat="Remplacé";
            $this->exe->id_ouvrage=$e->id_ouvrage;
            $this->exe->date=$e->date;
            $this->exe->duree=$e->duree;
            $this->exe->valeur=$e->valeur;
            $this->exe->codeBarre=$e->codeBarre;
            $this->exe->id_remplace=$value->id2;
            $d=$this->exe->update();			
        }   
        echo(json_encode($d));
    }

    public function saveOuv()
	{
		$this->ouv->titre=$this->input->post("titre");
		$this->ouv->auteur=$this->input->post("auteur");
		$this->ouv->resume=$this->input->post("resume");
		$this->ouv->mots=$this->input->post("mots");
		if($this->input->post("id2")==""){
			$d=$this->ouv->insert();

		}else{

			$this->ouv->id=$this->input->post("id2");
			$d=$this->ouv->update();
		}

		echo(json_encode($d));
		
	}
    
    public function saveEdit()
	{
		$this->edit->nom=$this->input->post("nom");
		$this->edit->email=$this->input->post("email");
		if($this->input->post("id1")==""){
			$d=$this->edit->insert();

		}else{

			$this->edit->id=$this->input->post("id1");
			$d=$this->edit->update();
		}

		echo(json_encode($d));
		
    }
    
    public function getRecordOuv(){
        $this->exe->id=$this->input->post("id");
        $e=$this->exe->findById();
		$this->ouv->id=$e->id_ouvrage;
		echo(json_encode($this->ouv->findById()));
    }
    
    public function getRecordOuve(){
		$this->ouv->id=$this->input->post("id");
		echo(json_encode($this->ouv->findById()));
    }

    public function getRecordEdit(){
		$this->edit->id=$this->input->post("id");
		echo(json_encode($this->edit->findById()));
    }
    public function getRecordExe(){
		$this->exe->id=$this->input->post("id");
		echo(json_encode($this->exe->findById()));
    }

    public function getRecordCom(){
		$this->com->id=$this->input->post("id");
		echo(json_encode($this->com->findById()));
    }
    	
	public function deleteEdit(){
		$this->edit->id=$this->input->post("id");
		$d=$this->edit->delete();
		echo(json_encode($d));
    }
    
    public function deleteOuv(){
		$this->ouv->id=$this->input->post("id");
		$d=$this->ouv->delete();
        echo(json_encode($d));
	}
}


?>