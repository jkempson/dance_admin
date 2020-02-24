<?php
class Contact extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$html = (string) $this->load->view("contact/template",null,true);

		$this->load->model('pdf_model');
		$this->pdf_model->load($html, "Contacts.pdf", "landscape");
	}
	
}
?>