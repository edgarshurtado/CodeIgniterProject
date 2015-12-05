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
        $sql = "SELECT numero, descripcion_incidencia as tipo, descripcion, ubicacion, 
            `usuarios`.nombre as usuario, prioridad, fecha_alta
                from incidencias, usuarios, tipos_incidencias
                WHERE `incidencias`.idusuario = `usuarios`.id 
                AND `tipos_incidencias`.idtipo = `incidencias`.idtipo
                ORDER BY fecha_alta DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getOpenIncidentsNum()
    {
        $sql = "SELECT * from incidencias WHERE estado = 'ABIERTA'";

        $query = $this->db->query($sql);

        return $query->num_rownum_rows();
    }
}
