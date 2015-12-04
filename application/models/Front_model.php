<?php
/**
 * Class Front_model
 * @author Edgar S. Hurtado
 */
class Front_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOpenIncidents()
    {
        $sql = "SELECT numero, idtipo as tipo, descripcion, ubicacion, 
            idusuario as usuario, prioridad
                from incidencias
                WHERE estado = 'ABIERTA'";

        $query = $this->db->query($sql);

        return $query->result();
    }
}
