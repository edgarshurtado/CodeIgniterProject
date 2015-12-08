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
        $this->load->model('Crud_output');
        $this->load->library('session');
        date_default_timezone_set('Europe/Madrid');
    }


    public function incidencias()
    {
        $output = $this->Crud_output->incidencias();
        $this->load->view("incidents", $output);
    }

    public function usuarios()
    {
        
        $output = $this->Crud_output->usuarios(); 
        $this->load->view("users", $output);
    }

    public function roles()
    {
        $output = $this->Crud_output->roles();
        $this->load->view("rols", $output);
    }

    public function tiposIncidencias()
    {
        $output = $this->Crud_output->tiposIncidencias();
        $this->load->view("incidents_types", $output);
    }

    public function historic()
    {
        $output = $this->Crud_output->historic();
        $this->load->view("incidents_historic", $output);
    }
}
