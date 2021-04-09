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

class C_Securite extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Profil", "profil");
        $this->load->model("M_User", "user");
    }

    public function index()
    {

    }
    public function showProfil()
    {
        $data['listeProfil'] = $this->profil->findAll();
        $this->load->view('Securite/v_profil', $data);
    }
    public function showUser()
    {
        $data['listeProfil'] = $this->profil->findAll();
        $data['listeUser'] = $this->user->findAll();
        $this->load->view('Securite/v_user', $data);
    }



    public function saveUser(){
        $this->user->nom = $this->input->post("nom");
        $this->user->prenom = $this->input->post("prenom");
        $this->user->login = $this->input->post("login");
        $this->user->id_profil = $this->input->post("profil");
        $pwd = $this->input->post("pwd");
        $pwd2 = $this->input->post("pwd2");
        if($pwd == $pwd2){
            $this->user->pwd = $pwd;
            $d = $this->user->insert();
        }
        echo (json_encode($d));
        showUser();
    }

    public function saveProfil(){
        $this->profil->nom = $this->input->post("nom");
		if($this->input->post("id")==""){
			$d=$this->profil->insert();

		}else{

			$this->profil->id=$this->input->post("id");
			$d=$this->profil->update();
		}
        echo (json_encode($d));
        showProfil();
    }

	public function deletePro(){
		$this->profil->id=$this->input->post("id");
		$d=$this->profil->delete();
        echo(json_encode($d));
        showProfil();
    }
    
    
	public function getRecordPro(){
		$this->profil->id=$this->input->post("id");
		echo(json_encode($this->profil->findById()));
	
	}
}


?>