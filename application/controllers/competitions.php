<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Competitions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Do some default work: no return
		$this->load->model('competition_model');
		$this->load->helper('url');
	}
	
	function index() {
		$this->load->model('attendee_model');
		$data['records'] = $this->competition_model->retrieve_by_user_id($this->_current_user_id());
		$data['attendees'] = $this->attendee_model->joined_competitions($this->_current_user_id()); 
		$this->load->view('competitions/index', $data);
	}
	
	function create() {
		$this->load->helper('form');
		
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
		$this->load->helper('form');
	
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

	function search() {
		$data['records'] = $this->competition_model->get_active_competitions();
		$this->load->view('competitions/board', $data);	
	}
	
	function wall($competition_id) {
		$this->load->model('comment_model');
		$data['record'] = $this->competition_model->get_competition($competition_id);
		$data['alias'] = $this->_generate_alias($data['record']['user_id'], $data['record']['id']);
		$data['comments'] = $this->comment_model->retrieve_all_from_competition($competition_id);
		$this->load->view('competitions/wall', $data);
	}
	
	function comment() {
		$this->load->model('comment_model');
		$data['user_id'] = $this->_current_user_id();
		$data['competition_id'] = intval($this->input->post('competition_id'));
		$data['text'] = trim($this->input->post('comment'));
		if(empty($data['text'])) {
			redirect('competitions/wall/' . $data['competition_id']);
			exit;
		}
		$this->comment_model->add_comment($data);
		redirect('competitions/wall/' . $data['competition_id']);
	}
	
	function signup() {
		$this->load->model('attendee_model');
		$user_id = intval($this->_current_user_id());
		$competition_id = intval($this->input->post('competition_id'));
		$this->attendee_model->add($user_id, $competition_id);
		redirect('competitions/search');
	}
	
	function _generate_alias($user_id, $competition_id) {
		$hash = md5($user_id . $competition_id);
		$alias = preg_replace("/[0-9]+/", "", $hash);
		return substr($alias, 0, 5);		
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
