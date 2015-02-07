<?php
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
		$this->load->helper('url');
		$this->load->library('pagination');
	}

	public function index()
	{
		//$data['news'] = $this->news_model->get_news();
		$data['title'] = 'News List';

		
		
		$config = array();
		$config['base_url'] = 'http://localhost:82/ci/news';
		$config['total_rows'] = $this->news_model->record_count();;
		$config['per_page'] = 5;
		$config["uri_segment"] = 2;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data["news"] = $this->news_model->fetch_news($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);
		$this->load->view('templates/footer');
		
		
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
			$this->news_model->add_news();
			redirect(base_url().'news/');
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
			$this->load->view('news/edit',$data);
		}
	}
	public function update(){
		$data = $this->input->post();
		$result = $this->news_model->update($data);
		redirect(base_url().'news');         
	}
}