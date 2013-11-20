<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Scorecard_model extends CI_Model {
  
	private $table = 'scorecards';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }
 
  function create($user_id) {
  	$sql = 'INSERT IGNORE INTO scorecards (user_id) VALUES (?)';
  	$query = $this->db->query($sql, array($user_id));
  }
  
  function update($user_id, $type) {
  	$sql = 'UPDATE scorecards SET ' . $type . ' = ' . $type . ' + 1 WHERE user_id = ?';
  	$query = $this->db->query($sql, array($user_id));
  }

}