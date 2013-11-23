<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Solution_model extends CI_Model {
  
	private $solutions_table = 'solutions';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }

  
  public function insert($data) {
  	$this->db->insert($this->solutions_table, $data);
  	return $this->db->insert_id();
  }
   
  public function get_submitted_solutions($user_id, $competition_id)
  {
  	$sql = 'SELECT * FROM solutions WHERE user_id =? AND competition_id = ?';
  	$query = $this->db->query($sql, array($user_id, $competition_id));
  	return $query->result_array();
  }
   
  public function delete($user_id, $solution_id)
  {
  	$solution = $this->get_solution($solution_id);
  	if (!$this->db->where('id', $solution_id)->where('user_id', $user_id)->delete($this->solutions_table)) {
  		return FALSE;
  	}
  	unlink($solution->file_path);
  	return TRUE;
  }
   
  public function get_solution($solution_id)
  {
  	return $this->db->select()
  	->from($this->solutions_table)
  	->where('id', $solution_id)
  	->get()
  	->row();
  }
 
}