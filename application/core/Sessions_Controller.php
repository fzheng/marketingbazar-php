<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Check if user is logged in with session
class Sessions_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $sessionData = $this->session->all_userdata();
        if(empty($sessionData['user_id'])) {
        	$this->load->helper('url');
        	redirect('main');
        }
    }
    
    function _current_user_id() {
    	$sessionData = $this->session->all_userdata();
    	return $sessionData['user_id'];
    }

}

