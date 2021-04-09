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

class C_Inscription extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Emprunteur", "emp");
    }

    public function index()
    {

    }
    public function showIns()
    {
        $data['listeEmp'] = $this->emp->findAll();
        $this->load->view('inscription/v_inscription', $data);
    }


    public function saveEmp(){
        $code=bin2hex(random_bytes(3)); 
        $this->emp->codeBarre = 'Emp_'.$code;
        $this->emp->nom = $this->input->post("nom");
        $this->emp->prenom = $this->input->post("prenom");
        $this->emp->email = $this->input->post("email");
        $this->emp->adresse = $this->input->post("adresse");
		if($this->input->post("id")==""){
			$d=$this->emp->insert();
		}else{

			$this->emp->id=$this->input->post("id");
			$d=$this->emp->update();
        }
        echo (json_encode($d));
    }

	public function deleteEmp(){
		$this->emp->id=$this->input->post("id");
		$d=$this->emp->delete();
		echo(json_encode($d));
        showIns();
    }
    
    public function getRecordEmp(){
		$this->emp->id=$this->input->post("id");
		echo(json_encode($this->emp->findById()));
	
	}
}


?>