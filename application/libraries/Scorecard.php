<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scorecard {
	private $CI;
	private $score_types = array(
		"five_day_visit" => '+ 5',
		"facebook_connect" => '+ 5',
		"twitter_connect" => '+ 5',
		"linkedin_connect" => '+ 5',
		"refer_friends" => '+ 5',
		"complete_profile" => '+ 10',
		"project_signup" => '+ 10',
		"solution_submission" => '+ 50',
		"fail_submission" => '- 20',
		"third_place" => '+ 100',
		"second_place" => '+ 300',
		"first_place" => '+ 600',
		"written_reviews" => '+ 50'
	);
	
    public function __construct() {
    	$this->CI =& get_instance();
    	$this->CI->load->model('scorecard_model');
    	$this->CI->load->model('score_model');
    }
    
    public function create_user_score($user_id) {
    	$this->CI->scorecard_model->create($user_id);
    	$this->CI->score_model->create($user_id);
    }
    
    public function update($type, $user_id) {
    	if(array_key_exists($type, $this->score_types)) {
    		$this->CI->scorecard_model->update($user_id, $type);
    		$this->CI->score_model->update($user_id, $this->score_types[$type]);
    	}
    }
    
}

?>