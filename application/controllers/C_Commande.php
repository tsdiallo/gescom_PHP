<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Commande extends CI_Controller {

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

	public	function showCommande(){
	  $data['all_data_client']=$this->mclient->findAll(); 
	  $data['all_data_article']=$this->marticle->findAll();
	  $data['all_data_details']=$this->mdetails->findAll();
		$this->load->view('commande/v_commande',$data);
	}
	
	public	function showCommandeLivre(){
			$data['all_data']=$this->mcommande->findCommandeByEtat(0);
		    $this->load->view('commande/v_cmdeLivre',$data);
	  }

	  public function ShowFacture(){
		  $data['all_data_fact']=$this->mcommande->findCommandeLivre();
		$this->load->view('Commande/v_facture',$data);
	}
	
	public function ShowLivraison(){
		$data['all_data']=$this->mcommande->findCommandeByEtat(0);
		$this->load->view('Commande/v_livraison',$data);
	}

	public function ShowOffre(){
		$this->load->view('Commande/v_offre');
	}

	public function saveClient(){
		$this->mclient->nom=$this->input->post("nom");
		$this->mclient->prenom=$this->input->post("prenom");
		$this->mclient->telephone=$this->input->post("telephone");
		$this->mclient->email=$this->input->post("email");
		$this->mclient->adresse=$this->input->post("adresse");
		$d=$this->mclient->insert();
		echo json_encode($d);
	}

	public function saveCommande(){



		//Validation des Données
		/*
	      	Regles de Validation
		*/
			   $_POST = $this->security->xss_clean($_POST);
			   
				$this->form_validation->set_rules('numero', 'Numero', 'required',
				array("required"=>"%s est Obligatoire"));
				$this->form_validation->set_rules('date', 'Date de la Commande', 'required',
				array("required"=>"%s est Obligatoire"));
				$this->form_validation->set_rules('client_id', 'Client', 'required|numeric',
				array("required"=>"%s est Obligatoire",
						"numeric"=>"Le champ est numérique"));

				$this->form_validation->set_rules('details', 'Commande', 'callback_verif_details');

				if ($this->form_validation->run() == FALSE)
                {
					$d=array(
						"statut"=>"error",
						"message"=>$this->form_validation->error_array()
					   ); 
                }
                else
                {
                 //Enregistrement de la Commande
						$this->mcommande->numero=$this->input->post("numero");
						$this->mcommande->date=$this->input->post("date");
						$this->mcommande->client_id=$this->input->post("client_id");
						$this->mcommande->montant=0;
						//Json to Array
						$details=json_decode($this->input->post("details"));
						/*
						Commande sans Qte Livrée
						*/
						$this->mcommande->etat=0;
						$d=$this->mcommande->insert();
						//Enregistrement des Details de la Commande
						if(!empty($d) && $d['id']>0){

						foreach ($details as  $value) {
							$this->mdetails->id=null;
							$this->mdetails->commande_id=$d['id'];
							$this->mdetails->article_id=$value->id;
							$this->mdetails->qtecom= $value->qtecom;
							$this->mdetails->qteliv=0;
							$this->mdetails->insert();
						}
						
						}      
                }
		

		  echo json_encode($d);
		  die();
	}


	public function verif_details($details){

	 $details=json_decode($details);
	 if (empty($details) || count($details)==0)
	 {
			 $this->form_validation->set_message('verif_details', 'La {field} doit contenir au moins un Article');
			 return FALSE;
	 }
	 else
	 {
			 return TRUE;
	 }

	}

}




