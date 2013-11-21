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
  
  function rank($user_id) {
  	$sql = 'SELECT s1.*, (SELECT COUNT(*) FROM scores s2 WHERE (s2.score, s2.user_id) >= (s1.score, s2.user_id)) AS rank FROM scores s1 WHERE s1.user_id = ?';
  	$query = $this->db->query($sql, array($user_id));
  	$result = $query->row_array();
  	$rank = (!empty($result) && isset($result['rank'])) ? $result['rank'] : 'Unavailable'; 
  	return $rank;  		
  }
  
  function score($user_id) {
  	$sql = 'SELECT scores.score FROM scores WHERE user_id = ?';
  	$query = $this->db->query($sql, array($user_id));
  	$result = $query->row_array();
  	$score = (!empty($result) && isset($result['score'])) ? $result['score'] : 'Unavailable';
  	return $score;
  }

}