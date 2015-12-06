<?php
/**
 * Class Database_retrieve
 * @author Edgar S. Hurtado
 */
class Database_retrieve extends CI_Model
{
    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getIncidentTypeName($typeid)
    {
        $sql = "SELECT descripcion_incidencia
                FROM tipos_incidencias
                WHERE idtipo = $typeid";

        $query = $this->db->query($sql);

        $row = $query->row();

        if(isset($row)){
            return $row->descripcion_incidencia;
        } else {
            return "tipo incidencia desconocido";
        }
    }

    /**
     * Given an incidents type id it returns as an array all the technicians
     * for that kind of incident
     */
    public function getTechniciansEmails($typeid)
    {
        $sql = "SELECT idusuario, idusuario2, idusuario3
                FROM tipos_incidencias
                WHERE idtipo = $typeid";

        $query = $this->db->query($sql);

        $row = $query->row();

        $emails = array();

        $fields = array("idusuario", "idusuario2", "idusuario3");
        if(isset($row)){
            foreach($fields as $field){
                $email = $row->$field;
                if(strlen($email) > 0){
                    $emails[$field] = $email;
                }
            }
        }

        return $emails;

    }
    
}
