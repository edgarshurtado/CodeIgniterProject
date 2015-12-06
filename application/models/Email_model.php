<?php


/**
 * Class Email_model
 * @author Edgar S. Hurtado
 */
class Email_model extends CI_Model
{
    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');

    }

    public function sendMail($to, $subject, $body)
    {
       $this->email->to("edsanhu@gmail.com");
       $this->email->from("system@edgarsh.es");
       $this->email->subject($subject);
       $this->email->message("$body");

       $this->email->send();
    }
    
}
