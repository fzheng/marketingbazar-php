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
							'field' => 'statement',
							'label' => 'Problem Statement',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'project_type',
							'label' => 'Project Type',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'scope',
							'label' => 'Project Scope',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'platform',
							'label' => 'Project Platform',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'must_haves',
							'label' => 'Must Have',
							'rules' => 'trim'
					),

					array(
							'field' => 'nice_haves',
							'label' => 'Nice to Have',
							'rules' => 'trim'
					),
					array(
							'field' => 'not_haves',
							'label' => 'Must Not Have',
							'rules' => 'trim'
					),

					array(
							'field' => 'criteria',
							'label' => 'Criteria',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'deliverables',
							'label' => 'Deliverables',
							'rules' => 'trim|required'
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
					),
					array(
							'field' => 'award',
							'label' => 'Award',
							'rules' => 'trim|required'
					)
			)										
	);

?>