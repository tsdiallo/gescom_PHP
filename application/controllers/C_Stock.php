<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Stock extends CI_Controller {

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
	public function __construct(){
		parent::__construct();
		$this->load->model("M_Categorie","mcategorie");
		$this->load->model("M_Article","marticle");
		$this->load->model("M_Client","mclient");
		$this->load->model("M_Commande","mcommande");
		$this->load->model("M_DetailsCommande","mdetails");
	}
	public function index()
	{

	}

	public	function showCategorie(){

      $data['all_data']=$this->mcategorie->findAll();
		$this->load->view('stock/v_categorie.php',$data);
	}

	public	function showArticle(){


		$data['select_data']=$this->mcategorie->findAll();
		$data['all_data']=$this->marticle->findAll();
		$this->load->view('stock/v_article.php',$data);
	}

	public	function showCommande(){
		$data['all_data_commande']=$this->mcommande->findAll();
		$this->load->view('stock/v_commande.php',$data);
	}

	public function showDetails(){
		echo json_encode($this->mdetails->findAllDetails($this->input->post("id"))); 
		//$data['all_data_article']=$this->mdetails->findArticleDetails();
	}

	//Save de Catégorie :Enregistrer et de Modifier

	public function save(){
		//my_debug($this->input->post());
		$this->mcategorie->libelle=$this->input->post("libelle");
		//hydrate($this->mcategorie,$this->input->post());
		if($this->input->post("id")==""){
            //insert
            $d=$this->mcategorie->insert();
		}else{
	         //update
			$this->mcategorie->id=$this->input->post("id");
			$d=$this->mcategorie->update();
		}
		
		echo(json_encode($d));

	}

	public function deleteCat(){
		$this->mcategorie->id=$this->input->post("id");
		$d=$this->mcategorie->delete();
		echo(json_encode($d));
	}


	//Save de Article :Enregistrer et de Modifier
	public function saveArticle(){

	$this->marticle->libelle=$this->input->post("libelle");
	$this->marticle->reference=$this->input->post("reference");
	$this->marticle->qtestock=$this->input->post("qtestock");
	$this->marticle->pu=$this->input->post("pu");
	$this->marticle->id_categorie=$this->input->post("id_categorie");

	if($this->input->post("id")==""){
		//insert
		$d=$this->marticle->insert();
	}else{
		 //update
		$this->marticle->id=$this->input->post("id");
		$d=$this->marticle->update();
	}
	
	  echo(json_encode($d));

	}
  
   public function getRecordArticle(){
		   $this->marticle->id=$this->input->post("id");
	  	echo  json_encode($this->marticle->findById())  ;				   
   }

	public function deleteArticle(){
		
	}
}




