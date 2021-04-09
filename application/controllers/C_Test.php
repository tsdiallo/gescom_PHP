<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Test extends CI_Controller {

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
	public function index()
	{
        echo  css_url("style");
        echo "Nous sommes des bleus en CodeIgniter";
		//$this->load->view('welcome_message');
    }

    public function test1()
	{
		$this->load->view('test/test1');
    }
    public function shownomprenom()
	{
        $data['nom']="Diop";
        $data['prenom']="Amadou";
        $data['lesnoms']=array("Diop","Faye","Ngom");
		$this->load->view('test/shownomprenom',$data);
    }

}
