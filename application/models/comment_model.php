<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Comment_model extends CI_Model {
  
  private $table = 'comments';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }

  
  function add_comment($data) {
  	$this->db->insert($this->table, $data);
    if($this->db->_error_message()) {
    	return FALSE;
    } else {
    	return TRUE;
    } 
  }  
  
  function retrieve_all_from_competition($competition_id) {
  	$sql = "SELECT * from comments where competition_id = ?";
  	$query = $this->db->query($sql, array($competition_id));
  	return $query->result_array(); 
  }

}