<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {


    function __construct() {
        parent::__construct();
        //Initialization code that affects all controllers
    }
    
    function _load_complete_view($view, $data){
    	$this->load->view('templates/header');
    	$this->load->view($view, $data);
    	$this->load->view('templates/footer');
    }

}

