<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->model('Users_model');
        $this->load->library('session');
        date_default_timezone_set('Europe/Madrid');
    }

	public function index()
	{
		$this->load->view('login2');
	}
    
    public function validateUser()
    {
        $userName = $_POST["user"];
        $password = $_POST["password"];
        $userData = $this->Users_model->getUser($userName, $password);
        if(! $userData == null){
            $this->session->set_userdata($userData);
            $this->load->view("welcome_message");
        } else {
            $this->load->view("login");
        }
    }

    public function logout(){
        $this->session->set_userdata('usuario', "");
        $this->session->sess_destroy();
        $this->load->view('login');
    }
}
