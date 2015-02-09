<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyUpload {

	public function upload($name) {
		$data = array('file_name' => '', 'error' => '');
		if($_FILES[$name]['name']!=""){
			$CI =& get_instance();
			//load library
			$CI->load->library('upload');

			//Set the config
			$config['upload_path'] = './uploads/'; //Use relative or absolute path
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']	= '1000';
			$config['max_width']  = '2500';
			$config['max_height']  = '2000';
			$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended

			//Initialize
			$CI->upload->initialize($config);

			//Upload file
			if( ! $CI->upload->do_upload($name)){
				//echo the errors
				$data['error'] = $CI->upload->display_errors();
			}
			//If the upload success
			$data['file_name'] = $CI->upload->file_name;

			//Save the file name into the db
		} else {
			$data['error'] = 'file name not exist!';
		}
		return $data;
	}
}