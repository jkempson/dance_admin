<?php
class Find extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('find_model');
	}

	public function index()
	{	
		$data['title'] = 'Search database';
		$data['searchbox'] = 'find';
		
		$result['query'] = $this->input->post('query');
		$result['records'] = $this->find_model->query($result['query']);
		
		$this->load->view('templates/header', $data);
		$this->load->view('find/results', $result);
		$this->load->view('templates/footer');
	}
	
}
?>