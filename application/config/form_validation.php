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
							'rules' => 'trim|required|is_numeric|max_length[9]'
					)
			),
		'competitions/update' => array(
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
							'rules' => 'trim|required|is_numeric|max_length[9]'
					),
					array(
							'field' => 'id',
							'label' => 'id',
							'rules' => 'trim'
					)
			),
		'accounts/profile' => array(
					array(
							'field' => 'first_name',
							'label' => 'First Name',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'last_name',
							'label' => 'Last Name',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'city',
							'label' => 'City',
							'rules' => 'trim'
					),
					array(
							'field' => 'state_province',
							'label' => 'State/Province',
							'rules' => 'trim'
					),
					array(
							'field' => 'country',
							'label' => 'Country',
							'rules' => 'trim|required'
					),
					array(
							'field' => 'postal_code',
							'label' => 'Postal Code',
							'rules' => 'trim'
					),
					array(
							'field' => 'phone',
							'label' => 'Phone Number',
							'rules' => 'trim'
					),
			
					array(
							'field' => 'email',
							'label' => 'Email',
							'rules' => 'trim|required|valid_email'
					),
					array(
							'field' => 'website',
							'label' => 'Website',
							'rules' => 'trim'
					),
			
					array(
							'field' => 'background',
							'label' => 'Background',
							'rules' => 'trim'
					),
					array(
							'field' => 'education',
							'label' => 'Education',
							'rules' => 'trim'
					),
					array(
							'field' => 'experience',
							'label' => 'Experience',
							'rules' => 'trim'
					),
					array(
							'field' => 'skills',
							'label' => 'Skills',
							'rules' => 'trim'
					),
					array(
							'field' => 'facebook',
							'label' => 'Facebook link',
							'rules' => 'trim'
					),
					array(
							'field' => 'linkedin',
							'label' => 'LinkedIn link',
							'rules' => 'trim'
					),
					array(
							'field' => 'twitter',
							'label' => 'Twitter link',
							'rules' => 'trim'
					),
					array(
							'field' => 'notifications',
							'label' => 'Notifications',
							'rules' => 'trim'
					),		
					array(
							'field' => 'id',
							'label' => 'id',
							'rules' => 'trim'
					)
			)													
	);

?>