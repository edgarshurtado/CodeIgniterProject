<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Email_controller
 * @author Edgar S. Hurtado
 */
class Email_controller extends CI_Controller
{
    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Email_model");
    }
    
    public function index()
    {
        $body = "Este es un mensaje de prueba 2";
        $this->Email_model->sendMail("edsanhu@gmail.com", "Test CI", $body);

        echo "Message sent";
        
    }
}
?>
