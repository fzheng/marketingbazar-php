<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('account_model');
	}
	
	function index() {
	}
	
	function profile() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if (isset($_POST['profile_form'])) {
			if ($this->form_validation->run() == FALSE) {
				$result['validation_error'] = TRUE;
				$this->load->view('accounts/profile', $result);
			} else {
				$post_data = $this->_get_profile_post_data();
				$this->account_model->insert_update_profile($post_data, $this->input->post('id'));
				redirect('/', 'refresh');
			}		
		} else {
			$profile = $this->account_model->get_profile_for($this->_current_user_id());
			$this->load->view('accounts/profile', $profile);
		}

	}	
	
	function _get_profile_post_data() {
		$data = array(
			'user_id' => $this->_current_user_id(),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'city' => $this->input->post('city'),
			'state_province' => $this->input->post('state_province'),				
			'country' => $this->input->post('country'),
			'postal_code' => $this->input->post('postal_code'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'website' => $this->input->post('website'),
			'background' => $this->input->post('background'),
			'education' => $this->input->post('education'),
			'skills' => $this->input->post('skills'),
			'experience' => $this->input->post('experience'),
			'facebook' => $this->input->post('facebook'),
			'linkedin' => $this->input->post('linkedin'),
			'twitter' => $this->input->post('twitter'),
			'notifications' => $this->input->post('notifications'),
		);
		return $data;
	}
	
	function _current_user_id() {
		return 1;	
	}
	
}
