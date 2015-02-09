<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->library('myupload');
		
		// check login
		if(!$this->session->userdata('logged_in'))
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		//$data['news'] = $this->news_model->get_news();
		$data['title'] = 'News List';

		
		// pagination configuration
		$config = array();
		$config['base_url'] = 'http://localhost:82/ci/news';
		$config['total_rows'] = $this->news_model->record_count();;
		$config['per_page'] = 5;
		$config["uri_segment"] = 2;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data["news"] = $this->news_model->fetch_news($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		

		// load template with data
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);
		$this->load->view('templates/footer');

		
		// load template with data
		// $this->load->view('templates/header', $data);
		// $this->load->view('news/index', $data);
		// $this->load->view('templates/footer');
		
		
	}

	public function show($id){
		$data['news_item'] = $this->news_model->get_news($id);
		//print_r($data);die();
		if (empty($data['news_item'])){
			show_404();
		}
		$data['title'] = $data['news_item']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('news/show', $data);
		$this->load->view('templates/footer');
	}
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create a news item';
		$data['error'] = '';

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('news/create');
			$this->load->view('templates/footer');

		}
		else
		{
			// save image name into db
			$image = $this->myupload->upload('photo');
			if ($image['error'] =='') {
				
				$slug = url_title($this->input->post('title'), 'dash', TRUE);

				$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'text' => $this->input->post('text'),
				'photo' => $image['file_name']
				);
				
				$this->news_model->add_news($data);
				redirect(base_url().'news/');

			} else {

				$data['error'] = $image['error'];
				$this->load->view('templates/header', $data);
				$this->load->view('news/create', $data);
				$this->load->view('templates/footer');
			}
		}
	}
	public function delete($id) {
		$this->news_model->delete_news($id);
		redirect(base_url().'news/');
	}
	public function edit($id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$result = $this->news_model->edit($id);
		if($result){
			$data['news'] = $result;
			$data['error'] = '';
			$this->load->view('news/edit',$data);
		}
	}
	public function update(){
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');
		$data['error'] = '';
		if ($this->form_validation->run() === FALSE)
		{
			$id = $this->input->post('id');
			$result = $this->news_model->edit($id);
			if($result){
				$data['news'] = $result;
				$this->load->view('news/edit',$data);
			}
		}
		else
		{
			// save image name into db
			$image = $this->myupload->upload('photo');
			if ($image['error'] =='') {
				
				$slug = url_title($this->input->post('title'), 'dash', TRUE);
				$data = array(
					'id' => $this->input->post('id'),
					'title' => $this->input->post('title'),
					'slug' => $slug,
					'text' => $this->input->post('text'),
					'photo' => $image['file_name']
				);
				
				$result = $this->news_model->update($data);
				redirect(base_url().'news');

			} else {
				
				$id = $this->input->post('id');
				$result = $this->news_model->edit($id);
				if($result){
					$data['news'] = $result;
					$data['error'] = $image['error'];
					$this->load->view('news/edit',$data);
				}
			}
			
		}
	}
}