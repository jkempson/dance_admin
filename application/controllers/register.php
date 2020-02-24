<?php
class Register extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$data['title'] = 'Select Term';
		$data['action'] = 'register';
		$data['submit_name'] = 'Create registers (PDF)';
		
		$post = $this->input->post();
		if ($post['term'] != "") 
		{
		  $html = (string) $this->load->view('register/template',$post,true);
		  $this->load->model('pdf_model');
		  $this->pdf_model->load($html, "Registers.pdf", "landscape");
		} else
		{
			$this->load->view('templates/header', $data);
			$this->load->view('register/term', $data);
			$this->load->view('templates/footer');
		}
	}
	
}
?>