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
        $sql= "SELECT email
                FROM usuarios, tipos_incidencias
                WHERE tipos_incidencias.idtipo = $typeid
                    AND `tipos_incidencias`.`idusuario` = usuarios.id
                    
                UNION

                SELECT email
                    FROM usuarios, tipos_incidencias
                    WHERE tipos_incidencias.idtipo = $typeid
                        AND `tipos_incidencias`.`idusuario2` = usuarios.id
                    
                UNION    
                        
                SELECT email
                    FROM usuarios, tipos_incidencias
                    WHERE tipos_incidencias.idtipo = $typeid
                        AND `tipos_incidencias`.`idusuario3` = usuarios.id";

        $query = $this->db->query($sql);

        $emails = array();

        foreach ($query->result() as $row) {
           $emails[] = $row->email;
        }

        return $emails;

    }

    public function getIncident($incidentId){
        $sql = "SELECT *
                FROM incidencias
                WHERE numero = ?";

        $query = $this->db->query($sql, array($incidentId));

        return $query->row();
    }

    public function getUserMail($userid)
    {
        $sql = "SELECT email
                FROM usuarios
                WHERE id = ?";

        $query = $this->db->query($sql, array($userid));

        return $query->row()->email;
    }
    
}
