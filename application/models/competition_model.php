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

  function remove($id) {
    //$this->db->delete($this->table, array('id' => $itemid));
  }

  function get_row_count() {
    //return $this->db->count_all($this->table);
  }


}