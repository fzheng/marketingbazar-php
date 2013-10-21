<?php 
class Profile extends CI_Controller {
	public function editprofile() {
		$this->load->helper ( array (
				'form',
				'url'
		) );
		$data = $this->loadcommon ();
		$siteid = $this->getsiteid ();
		$userid = $this->checklogin ();
		if ($userid > 0) {
			if (isset ( $_GET ['err'] )) {
				$data ['err'] = $_GET ['err'];
			}
			$data ['user'] = $this->getuser ( $userid );
			$this->load->view ( 'profile_edit', $data );
		}
	}
	
	public function checklogin($redirect = false) {
		$userid = $this->session->userdata ( 'userid' );
		if ($userid < 1 && $redirect) {
			$this->load->helper ( 'url' );
			redirect ( '/login/index?redirect=' . current_url (), 'refresh' );
			exit ();
		}
		return $userid;
	}
	
	public function getUser($id) {
		$this->db->where ( 'id', $id );
		$records = $this->db->get ( 'users' );
		if ($records->num_rows > 0) {
			$res = $records->result ();
			return $res [0];
		}
	}
}