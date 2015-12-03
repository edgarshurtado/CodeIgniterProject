<?php

/**
 * Class Crud_output
 * @author Edgar S. Hurtado
 */
class Crud_output extends CI_Model
{

    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct();
        //Grocery Crud
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->library('session');
        date_default_timezone_set('Europe/Madrid');
    }
    
    public function incidencias()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('incidencias');
        $crud->set_subject('Incidents');
        $crud->set_relation(
            'idtipo', 'tipos_incidencias', 'descripcion_incidencia');

        $invisibleFields = array("numero", "estado", "fecha_alta", 
            "fecha_fin", "idusuario");
        foreach($invisibleFields as $field){
            $crud->change_field_type($field, "invisible");
        }

        $crud->callback_before_insert(array($this, "new_incident_callback"));

        return $crud->render();
    }

    public function new_incident_callback($post_array)
    {
        $post_array['numero'] = intval(date("Ymdhi"));
        $post_array['idusuario'] = $this->session->id;
        $post_array['estado'] = "ABIERTA";
        $post_array['fecha_alta'] = date("Y-m-d h:i:s");
        $post_array['fecha_fin'] = "0000-00-00 00:00:00";

        return $post_array;
    }
}

