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
        $this->load->database();
    }
    
    /**
     * 
     * @return array("id" => user id, "name" => user name) or null if the
     * login is incorrect
     * @author Me
     **/
    function getUser($userName, $password){
        $sql = "SELECT *
                FROM usuarios
                WHERE nombre = ?";

        $query = $this->db->query($sql, array($userName));
        $userStoredPassword;
        $userID;
        $userName;

        foreach ($query->result() as $row){
            $userStoredPassword = $row->clave;
            $userID = $row->id;
            $userName = $row->nombre;
        }

        $userStoredPassword = $this->decrypt_password($userStoredPassword);

        if($password == $userStoredPassword){
            return array("id" => $userID, "name" => $userName);
        }else {
            return null;
        }

    }
                
    function encrypt_password($password){
        $encriptedPassword = $this->encrypt->encode($password);
        return $encriptedPassword;
    }

    function decrypt_password($password){
        return $this->encrypt->decode($password);
    }
}
