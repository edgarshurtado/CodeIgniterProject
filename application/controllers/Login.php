<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{
		$this->load->view('login');
	}

    public function test()
    {
        echo "Hola desde controlador";
    }

    public function validateUser()
    {
        $userName = $_POST["user"];
        $password = $_POST["password"];

        $data = array('user' => $userName, 'password' => $password);

        $this->load->view("admin.php", $data);
    }
}
