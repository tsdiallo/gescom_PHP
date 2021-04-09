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

class C_RPret extends CI_Controller
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
    public function showRPret()
    {
        $data['listePret'] = $this->pre->findAll();
        $data['listeOuv'] = $this->ouv->findAll();
        $data['listeEmp'] = $this->emp->findAll();
        $data['listeExe'] = $this->exe->findAll();
        $data['listeCom'] = $this->com->findAll();
        $data['listeDet'] = $this->det->findAll();
        $data['listeDetp'] = $this->detp->findAll();
        $data['listeEdit'] = $this->edit->findAll();
        $this->load->view('rpret/v_rpret', $data);
    }

    public function getRecordPret()
    {
        $this->pre->codeEmprunteur=$this->input->post("id");
		echo(json_encode($this->pre->findByCode()));
    }
    public function getRecordEmp()
    {
        $this->emp->codeBarre=$this->input->post("code");
		echo(json_encode($this->emp->findByCode()));
    }

    public function getRecordPret1(){
        $this->pre->id=$this->input->post("id_pret");
        $p=$this->pre->findById();
        echo(json_encode($p));

    }

    public function updatePret(){
        $this->pre->id=$this->input->post("id");
        $this->pre->etat="Retourné";
        $this->pre->codeEmprunteur=$this->input->post("codeEmprunteur");
        $this->pre->date=$this->input->post("date");
        $this->pre->dateretour=$this->input->post("dateretour");
        $d=$this->pre->update();
        echo(json_encode($d));
    }

    public function saveRPret(){
        $details=json_decode($this->input->post("details"));
        foreach($details as $det){
            $this->exe->codeBarre=$det->codeBarre;
            $e=$this->exe->findByCode();

            $this->exe->id=$e->id;
            $this->exe->date=$e->date;
            $this->exe->id_ouvrage=$e->id_ouvrage;
            $this->exe->id_remplace=$e->id_remplace;
            $this->exe->valeur=$e->valeur;
            $this->exe->duree=$e->duree;
            $this->exe->etat=$det->etat;
            $this->exe->codeBarre=$e->codeBarre;
            $d=$this->exe->update();
        }
        echo(json_encode($d));

    }
}


?>