<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Login extends CI_Controller {

	function __construct()
	{
	parent::__construct();
	}

	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('login_view');
	}
	public function logout()
	{
	   $this->session->unset_userdata('logged_in');
	   session_destroy();
	   redirect('home', 'refresh');
	}
}

?>