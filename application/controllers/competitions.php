<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @author Feng Zheng
 *        
 *         Linkedin API resource map: https://developer.linkedin.com/documents/linkedin-api-resource-map
 *        
 */
class Competitions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Do some default work: no return
	}
	
	function index() {
		$data['title'] = 'Competitions';
		$data['description'] = 'Should show a competitions front page';
		$this->load->view('competitions/index', $data);
	}
	
	function create() {
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('competitions/create');
		}
		else
		{
			redirect('competitions');
		}
	}
	
	function _check_valid_name($name) {
		if ($name == 'test') {
			$this->form_validation->set_message('_check_valid_name', 'The %s field can not be the word "test"');
			return FALSE;
		}
		else {
			return TRUE;
		}
		
	}
}
