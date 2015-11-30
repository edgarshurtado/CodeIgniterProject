<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->database();

        date_default_timezone_set('Europe/Madrid');
    }

	public function index()
	{
		$this->load->view('login');
	}

    public function validateUser()
    {
        $userName = $_POST["user"];
        $password = $_POST["password"];


        $data = array('user' => $userName, 'password' => $password);
        $this->load->model('users_model');
        if($this->users_model->isValidUser($userName, $password)){
            $this->load->view("admin", $data);
        } else {
            $this->load->view("login");
        }
    }

    public function incidencias()
    {

        $output = $this->grocery_crud->render();
        $this->load->view("incidencias", $output);
    }

    public function usuarios()
    {
        $crud = new grocery_CRUD();
        $crud->set_table("usuarios");
        $crud->fields("nombre", "clave", "email");
        
        $output = $crud->render();
        $this->load->view("incidencias", $output);
    }
}
