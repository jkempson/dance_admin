<?php
	class Home extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
		}
	
		public function index()
		{
			$data['title'] = 'Main Menu';
			$data['hidehome'] = 1;
			$this->load->view('templates/header', $data);
			$this->load->view('home/index', $data);
			$this->load->view('templates/footer');
	    }
	}
?>