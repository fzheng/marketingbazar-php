<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Solutions extends Sessions_Controller {

	private $upload_path = './uploads/solutions/';
	
	public function __construct() {
		parent::__construct();
		// Do some default work: no return
		$this->load->model('solution_model');
		$this->load->helper('url');
	}
	
	function submit($competition_id) {
		$data['competition_id'] = $competition_id;
		$data['solutions'] = $this->solution_model->get_submitted_solutions($this->_current_user_id(), $competition_id);
		$this->load->view('solutions/submit', $data);
	}
	
	function show($competition_id) {
		$data['competition_id'] = $competition_id;
		$this->load->model('competition_model');
		$is_owner = $this->competition_model->is_owner($this->_current_user_id(), $competition_id);
		if(!$is_owner) {
			$data['error_msg'] = 'You are not allowed to view solutions for this competition!';
			$this->load->view('solutions/show', $data);
		} else {
			$data['solutions'] = $this->solution_model->get_solutions_for_competition($competition_id);
			$this->load->view('solutions/show', $data);
		}		
	}
	
	function upload() {
		$file_element_name = 'solution';
		$status = 'success'; 
		if (empty($_POST['title'])) {
			$status = "error";
			$msg = "Please enter a title";
		}
		
		if(empty($_POST['competition_id']) || !is_numeric($_POST['competition_id'])) {
			$status = "error";
			$msg = "Invalid competition id";
		}
		 
		if ($status != "error")
		{
			$config['upload_path'] = $this->upload_path;
			$config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
			$config['max_size']  = 1024 * 8;
			$config['encrypt_name'] = TRUE;
			 
			$this->load->library('upload', $config);
 			
			if (!$this->upload->do_upload($file_element_name)) {
				$msg = $this->upload->display_errors('', '');
				throw new Exception($msg);
			}
			
			else {
				$data = $this->upload->data();
				$insert_data = $this->_get_insert_data($data); 
				$solution_id = $this->solution_model->insert($insert_data);
				if($solution_id) {
					$status = 'success';
					$msg = 'File uploaded';
					
				} else {
					unlink($data['full_path']);
					$status = 'error';
					$msg = 'Please try again';	
				}
			}
			@unlink($_FILES[$file_element_name]);
			redirect('competitions');
		}
	}
	
	function delete() {
		$solution_id = $_POST['solution_id'];
		$result = $this->solution_model->delete($this->_current_user_id(), $solution_id);
		if($result === false) {
			throw new Exception('Test');
		}
		redirect('competitions');
	}
	
	function download($competition_id, $solution_id) {
		$this->load->model('competition_model');
		$is_owner = $this->competition_model->is_owner($this->_current_user_id(), $competition_id);
		if(!$is_owner) {
			$data['error_msg'] = 'You are not allowed to view this solution!';
			$this->load->view('solutions/show', $data);
		} else {
			$solution = $this->solution_model->get_solution($solution_id);
			$this->_download_file($solution->file_path);
		}		
	}
	
	function _download_file($filename) {
		$file_extension = strtolower(substr(strrchr($filename,"."),1));
		
		switch ($file_extension) {
			case "pdf": $ctype="application/pdf"; break;
			case "zip": $ctype="application/zip"; break;
			case "doc": $ctype="application/msword"; break;
			case "xls": $ctype="application/vnd.ms-excel"; break;
			case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
			case "gif": $ctype="image/gif"; break;
			case "png": $ctype="image/png"; break;
			case "jpe": case "jpeg":
			case "jpg": $ctype="image/jpg"; break;
			default: $ctype="application/force-download";
		}
		
		if (!file_exists($filename)) {
			die("NO FILE HERE");
		}
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"".basename($filename)."\";");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".@filesize($filename));
		set_time_limit(0);
		@readfile("$filename") or die("File not found.");		
	}
	
	function _get_insert_data($data) {
		return array(
			'user_id' => $this->_current_user_id(),
			'competition_id' => $_POST['competition_id'],
			'file_name' => $data['file_name'],
			'file_path' => $data['full_path'],
			'title' => $_POST['title']	
		);
	}
	
}
