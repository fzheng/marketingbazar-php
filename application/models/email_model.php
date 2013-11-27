<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model
{
    private $email_config;
    private $CI;

    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->config->load("email", TRUE);
        $this->email_config = $this->CI->config->item("email");
        $this->CI->load->library("email");
        $this->CI->email->initialize($this->email_config);
    }

    function send($recipients, $emailSubject, $emailViewName, $data)
    {
        foreach ($recipients as $name => $address) {
            $this->CI->email->clear();
            $this->CI->email->to($address);
            $this->CI->email->from("mail@marketingbazar.com", "Marketingbazar");
            $this->CI->email->subject(str_replace("%name%", $name, $emailSubject));
            $message = $this->CI->load->view('emails/' . $emailViewName, $data, TRUE);
            $this->CI->email->message($message);
            $this->CI->email->send();
        }
    }
}