<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Competition_model extends CI_Model {
  
  private $table = 'competitions';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }


  /*
  function get_last_item()
  {
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get($this->table, 1);
    
    return $query->result();
  }
  */
  
  function insert($data) {
  	$this->db->insert($this->table, $data);
    if($this->db->_error_message()) {
    	return FALSE;
    } else {
    	return TRUE;
    } 
  }
  
  function update_entry($id, $data) {
  	$this->db->where('user_id', $data['user_id']);
  	$this->db->where('id', $id);
  	$this->db->update($this->table, $data);
  	if($this->db->_error_message()) {
  		return FALSE;
  	} else {
  		return TRUE;
  	}
  }  
  
  function retrieve_by_user_id($user_id) {
  	$sql = "SELECT id, name, begin_at, end_at FROM competitions WHERE user_id = ? AND deleted = 0";
  	$query = $this->db->query($sql, array($user_id));
  	return $query->result_array(); 
  }
  
  function retrieve_entry($user_id, $id) {
  	$sql = "SELECT * FROM competitions WHERE user_id = ? AND id = ?";
  	$query = $this->db->query($sql, array($user_id, $id));
  	return $query->row_array();
  }
  
  function get_active_competitions() {
  	$sql = "SELECT id, name, begin_at, end_at FROM competitions WHERE end_at > NOW() ORDER BY end_at";
  	$query = $this->db->query($sql);
  	return $query->result_array();
  }
  
  function get_competition($id) {
  	$sql = "SELECT * from competitions WHERE id = ?";
  	$query = $this->db->query($sql, $id);
  	return $query->row_array();
  }

  function get_row_count() {
    //return $this->db->count_all($this->table);
  }
  
  function get_owner($competition_id) {
  	$sql = 'SELECT users.username, users.email FROM competitions JOIN users ON competitions.user_id = users.id WHERE competitions.id = ?';
  	$query = $this->db->query($sql, $competition_id);
  	return $query->row_array();
  }
  
  function is_owner($user_id, $competition_id) {
  	$row = $this->db->select()
  	->from($this->table)
  	->where('id', $competition_id)
  	->where('user_id', $user_id)
  	->get()
  	->row();
  	
  	if(!empty($row)) {
  		return true;
  	} else {
  		return false;
  	}
  }


}