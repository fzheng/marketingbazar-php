<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Competitions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Do some default work: no return
		$this->load->model('competition_model');
	}
	
	function index() {
		$data['title'] = 'Competitions';
		$data['description'] = 'Your list of competitions';
		$data['records'] = $this->competition_model->retrieve_by_user_id($this->_current_user_id());
		$this->load->view('competitions/index', $data);
	}
	
	function create() {
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		if ($this->form_validation->run() == FALSE) {
			$result['validation_error'] = TRUE;
			$result['action'] = 'create';
			$this->load->view('competitions/form', $result);
		} else {
			$data = $this->_get_post_data();
			$result = $this->competition_model->insert($data);
			if($result === TRUE) {
			} else {
			}
			redirect('competitions');
		}
	}

	function edit($id) {
		$record = $this->competition_model->retrieve_entry($this->_current_user_id(), intval($id));
		$record['action'] = 'update';
		$this->load->view('competitions/form', $record);
	}

	function update() {
		$this->load->helper(array('form', 'url'));
	
		$this->load->library('form_validation');
	
		if ($this->form_validation->run() == FALSE) {
			$result['validation_error'] = TRUE;
			$result['action'] = 'update';
			$this->load->view('competitions/form', $result);
		} else {
			$data = $this->_get_post_data();
			$result = $this->competition_model->update_entry(intval($this->input->post('id')), $data);
			if($result === TRUE) {
			} else {
			}
			redirect('competitions');
		}
	}	
	
	function _get_post_data() {
		$data = array(
			'user_id' => $this->_current_user_id(),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'statement' => $this->input->post('statement'),
			'project_type' => $this->input->post('project_type'),				
			'scope' => $this->input->post('scope'),
			'platform' => $this->input->post('platform'),
			'must_haves' => $this->input->post('must_haves'),
			'nice_haves' => $this->input->post('nice_haves'),
			'not_haves' => $this->input->post('not_haves'),
			'criteria' => $this->input->post('criteria'),
			'deliverables' => $this->input->post('deliverables'),
			'begin_at' => $this->input->post('begin_at'),
			'end_at' => $this->input->post('end_at'),
			'award' => $this->input->post('award')								
		);
		return $data;
	}
	
	function _current_user_id() {
		return 0;	
	}
	
	function _check_valid_name($name) {
		if ($name == 'test') {
			$this->form_validation->set_message('_check_valid_name', 'The %s field can not be the word "test"');
			return FALSE;
		} else {
			return TRUE;
		}
		
	}
}