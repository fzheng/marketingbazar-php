<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Attendee_model extends CI_Model {
  
	private $profile_table = 'attendees';
  
  function __construct() {
    /* Call the Model constructor */
    parent::__construct();
  }
 
  function add($user_id, $competition_id) {
  	if(empty($user_id) || empty($competition_id)) {
  		return;
  	}
  	$sql = 'INSERT IGNORE INTO attendees (user_id, competition_id) VALUES (?, ?)';
  	$query = $this->db->query($sql, array($user_id, $competition_id)); 
  }
  
  function joined_competitions($user_id) {
  	$sql = 'SELECT attendees.id, attendees.competition_id, competitions.name, competitions.begin_at, competitions.end_at FROM attendees JOIN competitions WHERE attendees.competition_id = competitions.id AND attendees.user_id = ?';
  	$query = $this->db->query($sql, array($user_id));
  	return $query->result_array();
  }
  
  function get_attendees_for($competition_id) {
  	$sql = 'SELECT users.username, users.email FROM attendees JOIN users ON attendees.user_id = users.id WHERE attendees.competition_id = ?';
  	$query = $this->db->query($sql, array($competition_id));
  	return $query->result_array();
  }
}