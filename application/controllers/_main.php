<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function Main() {
		parent::__construct();
		parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
		$CI = & get_instance();
		$CI->config->load("facebook",TRUE);
		$this->load->helper("url");
		$config = $CI->config->item('facebook');
		$this->load->library('Facebook', $config);
	}
	
	function index() {
		// Try to get the user's id on Facebook
		$userId = $this->facebook->getUser();
		// If user is not yet authenticated, the id will be zero
		if (!$userId) {
			// Generate a login url
			$data['url'] = $this->facebook->getLoginUrl(array('scope'=>'email'));
			$this->load->view('gateway', $data);
		} else {
			// Get user's data and show the main page
			$data['user'] = $this->facebook->api('/me');
			$data['logoutUrl'] = $this->facebook->getLogoutUrl(array('next'=>(base_url()."main/logout")));
			$this->load->view('home', $data);
		}
	}
	
	public function logout() {
		if ($this->facebook->getUser()) {
			setcookie('fbs_'.$this->facebook->getAppId(), '', time()-100, '/', 'marketingbazar.com');
			session_destroy();
			header('Location: /');
		}
	}
}