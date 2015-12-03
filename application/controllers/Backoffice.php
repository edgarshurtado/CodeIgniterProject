<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //Grocery Crud
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->model('Users_model');
        $this->load->library('session');
        date_default_timezone_set('Europe/Madrid');
    }


    public function incidencias()
    {
        $this->load->model('Crud_output');
        $output = $this->Crud_output->incidencias();
        $this->load->view("admin", $output);
    }

    public function usuarios()
    {
        $crud = new grocery_CRUD();
        $crud->set_table("usuarios");
        $crud->columns("nombre", "clave", "email");
        $crud->fields("nombre", "clave", "email");
        $crud->field_type("clave", "password");
        $crud->required_fields("nombre", "clave", "email");
        $crud->callback_before_insert(
            array($this, "encrypt_password_callback"));
        
        $output = $crud->render();
        $this->load->view("admin", $output);
    }

    function encrypt_password_callback($post_array){
        $post_array['clave'] = 
            $this->Users_model->encrypt_password($post_array['clave']);

        return $post_array;
    }

    public function roles()
    {
        $crud = new grocery_CRUD();
        $crud->set_table("roles");
        $crud->field_type("nivel", "dropdown", array(0,1,2,3));

        $output = $crud->render();
        $this->load->view("admin", $output);
    }

    public function tiposIncidencias()
    {
        $crud = new grocery_CRUD();
        $crud->set_table("tipos_incidencias");

        $output = $crud->render();
        $this->load->view("admin", $output);
    }
}
