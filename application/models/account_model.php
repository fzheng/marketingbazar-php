<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Account_model extends CI_Model {
  
	private $profile_table = 'profiles';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }
 
  function get_profile_for($user_id) {
  	$table = $this->profile_table;
  	$sql = "SELECT * FROM $table WHERE user_id = ?";
  	$query = $this->db->query($sql, array($user_id));
  	return $query->row_array(); 
  }

  function insert_update_profile($post_data, $id = NULL) {
  	// do update if we have profile id
  	if(isset($id) && is_numeric($id)) {
  		$id = intval($id);
  		$this->db->where('id', $id);
  		$this->db->where('user_id', $post_data['user_id']);
  		$this->db->update($this->profile_table, $post_data);
  	} else {
  		// do insert
  		$this->db->insert($this->profile_table, $post_data);
  		if($this->db->_error_message()) {
  			return FALSE;
  		} else {
  			$this->load->library('scorecard');
  			$this->scorecard->update('complete_profile', $post_data['user_id']);
  			return TRUE;
  		}
  	}
  }
}