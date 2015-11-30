<?php

/**
 * Class Users_model
 * @author Edgar S. Hurtado
 */
class Users_model extends CI_Model
{
    /**
     * @param mixed 
     */
    public function __construct()
    {
        $this->load->library('encrypt');
    }
    
    function isValidUserEncrypt($userName, $password){
        $this->load->database();           

        $sql = "SELECT *
                FROM usuarios
                WHERE nombre = ?";

        $query = $this->db->query($sql, array($userName));
        $userStoredPassword;

        foreach ($query->result() as $row){
            $userStoredPassword = $row->clave;
        }

        $userStoredPassword = $this->decrypt_password($userStoredPassword);

        return $password == $userStoredPassword;

    }

    function encrypt_password($password){
        $encriptedPassword = $this->encrypt->encode($password);
        return $encriptedPassword;
    }

    function decrypt_password($password){
        return $this->encrypt->decode($password);
    }
}
