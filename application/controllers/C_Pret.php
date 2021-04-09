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

class C_Pret extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Pret", "pre");
        $this->load->model("M_Ouvrage", "ouv");
        $this->load->model("M_Exemplaire", "exe");
        $this->load->model("M_Emprunteur", "emp");
        $this->load->model("M_Commande", "com");
        $this->load->model("M_Detailcommande", "det");
        $this->load->model("M_Detailpret", "detp");
        $this->load->model("M_Editeur", "edit");
    }

    public function index()
    {

    }
    public function showPret()
    {
        $data['listePret'] = $this->pre->findAll();
        $data['listeOuv'] = $this->ouv->findAll();
        $data['listeEmp'] = $this->emp->findAll();
        $data['listeExe'] = $this->exe->findAll();
        $data['listeCom'] = $this->com->findAll();
        $data['listeDet'] = $this->det->findAll();
        $data['listeDetp'] = $this->detp->findAll();
        $data['listeEdit'] = $this->edit->findAll();
        $this->load->view('pret/v_pret', $data);
    }
    public function savePret()
	{
			//enregistrement dU PRET
            $e=$this->input->post("id_emp");
			$this->pre->date=$this->input->post("date");
			$this->pre->dateretour=$this->input->post("date");
			$this->pre->etat="Non retourné";
			$this->pre->codeEmprunteur=$this->input->post("codeEmp");
			$d=$this->pre->insert();
			//json to array
            echo(json_encode($d));
    }

    public function saveDetailsPret(){
        $details=json_decode($this->input->post("details"));
        foreach ($details as $value) {
            $this->detp->id_pret=$this->input->post("id");
            $this->detp->codeBarre=$value->codeBarre;
            $this->detp->titre=$value->titre;	

            $this->exe->id=$value->id;
            $e=$this->exe->findById();

            $this->exe->id=$e->id;
            $this->exe->date=$e->date;
            $this->exe->valeur=$e->valeur;
            $this->exe->duree=$e->duree;
            $this->exe->id_ouvrage=$e->id_ouvrage;
            $this->exe->id_remplace=$e->id_remplace;
            $this->exe->codeBarre=$e->codeBarre;
            $this->exe->etat="Emprunté";
            $this->exe->update();
            $d=$this->detp->insert();		
        }
            echo(json_encode($d));
    }

}


?>