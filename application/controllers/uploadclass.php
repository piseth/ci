<?php

class Uploadclass extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('upload_view', array('error' => ' ' ));
	}

	public function uploadFile()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2500';
		$config['max_height']  = '2000';
		//print_r($config);die();
		$this->load->library('upload', $config);
		$field_name = "photo";
		if (!$this->upload->do_upload($field_name))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_view', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success_view', $data);
		}
	}
}
?>