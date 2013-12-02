<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends Sessions_Controller {

	public function __construct() {
		parent::__construct();
		// Do some default work: no return
		$this->load->helper('url');
		$this->load->model('competition_model');
		$this->load->model('attendee_model');
	}
	
	function index() {
		redirect('main');
	}
	
	function payout($competition_id) {
		$data['competition'] = $this->competition_model->retrieve_entry($this->_current_user_id(), intval($competition_id));
		$data['attendees'] = $this->attendee_model->get_attendees_for($competition_id);
		$this->_load_complete_view('payment/payout', $data);
	}
	
	function prepare() {
		$this->load->library('paypalpayment');
		$result = $this->paypalpayment->payUsers($_POST);
		if($result === FALSE) {
			header('Content-type: application/json', TRUE, 400);
		} else {
			header('Content-type: application/json');
		}
		echo json_encode(array('paykey' => $result));
	}
}
