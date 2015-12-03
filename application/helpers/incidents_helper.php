<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
if(!function_exists('incidencias_no_resuletas')){

    function incidencias_no_resuletas()
    {
        $CI = & get_instance();

        $sql = "SELECT count(*) AS num 
                FROM incidencias
                WHERE estado <> 'CERRADA'";

        $query = $CI->db->query($sql);

        $fila = $query->row();

        return $fila->num;
    }
}
?>
