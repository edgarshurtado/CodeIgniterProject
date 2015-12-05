<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Front_controller
 * @author Edgar S. Hurtado
 */
class Front_controller extends CI_Controller
{
    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model("Front_model");
        $this->load->library("pagination");

        $incidents =$this->Front_model->getOpenIncidents();


        $data = array("incidents" => $incidents);
        $this->load->view('front', $data);
    }
    
}
?>
