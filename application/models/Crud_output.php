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
        $this->load->model('email_model');
        $this->load->model('database_retrieve');
        date_default_timezone_set('Europe/Madrid');
    }
    
    public function incidencias()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('incidencias');
        $crud->set_subject('Incidents');
        $crud->set_relation( 'idtipo', 'tipos_incidencias',
           'descripcion_incidencia');

        $crud->field_type('idusuario', 'hidden');
        $crud->field_type('fecha_alta', 'hidden');
        $crud->field_type('fecha_fin', 'hidden');
        $crud->field_type('numero', 'hidden');

        $crud->edit_fields("descripcion", "estado", "numero", "fecha_fin");

        $crud->callback_before_insert(array($this, "new_incident_callback"));
        $crud->callback_before_update(array($this, "edit_incident_callback"));

        return $crud->render();
    }

    public function new_incident_callback($post_array)
    {
        $post_array['numero'] = intval(date("YmdHi"));
        $post_array['idusuario'] = $this->session->id;
        $post_array['fecha_alta'] = date("Y-m-d H:i:s");
        $post_array['fecha_fin'] = "0000-00-00 00:00:00";

        //Email configuration
        $body = "Numero Incidencia: ". $post_array['numero'] . "\n";
        $body = $body . "Fecha alta: ".$post_array['fecha_alta'] . "\n";
        $typeIncidentName = $this->database_retrieve-> 
            getIncidentTypeName($post_array['idtipo']);
        $body = $body . "Tipo Incidencia: ". $typeIncidentName . "\n";
        $body = $body ."Decripcion: \n".$post_array['descripcion'] . "\n";

        $to = $this->database_retrieve->
            getTechniciansEmails($post_array['idtipo']);

        $this->email_model->mailNewIncident($to, $body);

        return $post_array;
    }

    public function edit_incident_callback($post_array)
    {
        $this->email_model->mailNewIncident("edsanhu@gmail.com", "test");

        return $post_array;
    }

    public function usuarios()
    {
        $crud = new grocery_CRUD();
        $crud->set_table("usuarios");
        $crud->columns("nombre", "clave", "email", "idrol");
        $crud->fields("nombre", "clave", "email", "idrol");
        $crud->set_relation("idrol", "roles", "descripcion");
        $crud->display_as("idrol", "Rol");
        $crud->field_type("clave", "password");
        $crud->required_fields("nombre", "clave", "email");
        $crud->callback_before_insert(
            array($this, "encrypt_password_callback"));
        
        return $crud->render();
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

        return $crud->render();
    }

    public function tiposIncidencias()
    {
        $crud = new grocery_CRUD();
        $crud->set_table("tipos_incidencias");
        $crud->set_relation("idusuario", "usuarios", "email");
        $crud->display_as("idusuario", "Técnico 1");
        $crud->set_relation("idusuario2", "usuarios", "email");
        $crud->display_as("idusuario2", "Técnico 2");
        $crud->set_relation("idusuario3", "usuarios", "email");
        $crud->display_as("idusuario3", "Técnico 3");

        return $crud->render();
    }
}

