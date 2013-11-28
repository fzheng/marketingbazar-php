<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends Sessions_Controller {

	public function __construct() {
		parent::__construct();
		// Do some default work: no return
		$this->load->helper('url');
	}
	
	function index() {
		$this->_load_complete_view('payment/index', '');
	}
}
