<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$config = array(
			'competitions/create' => array(
					array(
							'field' => 'name',
							'label' => 'Competition Name',
							'rules' => 'trim|required|callback__check_valid_name'
                   	),
					array(
							'field' => 'description',
							'label' => 'Competition Description',
							'rules' => 'trim|required|max_length[140]'
					),
					array(
							'field' => 'begin_at',
							'label' => 'Begin Time',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'end_at',
							'label' => 'End Time',
							'rules' => 'trim|required'
					)
			)										
	);

?>