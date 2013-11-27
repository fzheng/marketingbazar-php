<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User_model extends CI_Model {
  
	private $table = 'users';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }
 
  function get_user($user_id) {
  	$query = $this->db->get_where($this->table, array('id' => $user_id));
  	return $query->row_array(); 
  }


}