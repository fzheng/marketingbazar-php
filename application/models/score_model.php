<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Score_model extends CI_Model {
  
	private $table = 'scores';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }
 
  function create($user_id) {
  	$sql = 'INSERT IGNORE INTO scores (user_id) VALUES (?)';
  	$query = $this->db->query($sql, array($user_id));
  }
  
  function update($user_id, $value) {
  	$sql = 'UPDATE scores SET score = score ' . $value . ' WHERE user_id = ?';
  	$query = $this->db->query($sql, array($user_id));
  }

}