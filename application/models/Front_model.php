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

    public function getOpenIncidents($final, $start=0)
    {
        $sql = "SELECT numero, descripcion_incidencia as tipo, descripcion, 
            ubicacion, `usuarios`.nombre as usuario, prioridad, fecha_alta,
            estado
                from incidencias, usuarios, tipos_incidencias
                WHERE `incidencias`.idusuario = `usuarios`.id 
                AND `incidencias`.estado <> 'CERRADA'
                AND `tipos_incidencias`.idtipo = `incidencias`.idtipo
                ORDER BY fecha_alta DESC
                LIMIT $start, $final";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getOpenIncidentsNum()
    {
        $sql = "SELECT * 
            FROM incidencias, usuarios
            WHERE estado <> 'CERRADA' 
            AND `incidencias`.idusuario = `usuarios`.id";

        $query = $this->db->query($sql);

        return $query->num_rows();
    }
}
