<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->database();
        $this->load->model('Users_model');
        $this->load->library('session');
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

        if($this->Users_model->isValidUserEncrypt($userName, $password)){
            $this->session->set_userdata('usuario', $userName);
            $this->load->view("admin");
        } else {
            $this->load->view("login");
        }
    }

    public function incidencias()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('incidencias');
        $crud->set_subject('Incidents');
        $crud->set_relation(
            'idtipo', 'tipos_incidencias', 'descripcion_incidencia');

        $output = $crud->render();
        $this->load->view("incidencias", $output);
    }

    public function usuarios()
    {
        $crud = new grocery_CRUD();
        $crud->set_table("usuarios");
        $crud->columns("nombre", "clave", "email");
        $crud->fields("nombre", "clave", "email");
        $crud->field_type("clave", "password");
        $crud->required_fields("nombre", "clave", "email");
        $crud->callback_before_insert(array($this, "encrypt_password_callback"));
        
        $output = $crud->render();
        $this->load->view("incidencias", $output);
    }

    function encrypt_password_callback($post_array){
        $post_array['clave'] = 
            $this->Users_model->encrypt_password($post_array['clave']);

        return $post_array;
    }
}
