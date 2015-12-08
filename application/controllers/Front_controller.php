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

    public function index($page = 0)
    {
        $this->load->model("Front_model");
        $this->load->library("pagination");
        
        $config['base_url'] = 'http://localhost/Server_BackEnd/proyectos/codeingnite-project/';
        $config['total_rows'] = $this->Front_model->getOpenIncidentsNum();
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $startPoint = $page;
        $finalPoint = $startPoint + $config['per_page'];
        $incidents =$this->Front_model->getOpenIncidents($finalPoint, $startPoint);

        $data = array("incidents" => $incidents,
            "links" => $this->pagination->create_links());
        $this->load->view('front2', $data);
    }
    
}
?>
