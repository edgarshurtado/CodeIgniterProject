<?php

/**
 * Class Users_model
 * @author Edgar S. Hurtado
 */
class Users_model extends CI_Model
{
    function isValidUser($userName, $password){
        $this->load->database();           

        $sql = "SELECT *
                FROM usuarios
                WHERE nombre = ?
                AND clave = ?";

        $query = $this->db->query($sql, array($userName, $password));

        return $query->num_rows() == 1;

    }
}
