<?php
class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_model');
		$this->load->model('finance_model');
	}

	public function view()
	{
		$id = end($this->uri->segments);
		$query = $this->db->get_where('Account', array('id' => $id ));
		$data['account'] = $query->row_array(); 
		$data['title'] = 'Account Overview';
		$data['balance']=$this->finance_model->accountbalance($id);
		$this->load->view('templates/header', $data);
		$this->load->view('account/view', $data);
		$this->load->view('templates/footer');
	}

	public function managepupils($account_id=NULL) {
		if (isset($account_id))
		{
		$query = $this->db->get_where('view_pupil', array('Account_id' => end($this->uri->segments)));
		$data['pupils'] = $query->result_array(); 
		$data['title'] = 'Manage Pupils';
		$data['account_id']=$account_id;
		$this->load->view('templates/header', $data);
		$this->load->view('account/managepupils', $data);
		$this->load->view('templates/footer');
		}
	}
	
	public function add()
	{
		$this->process(NULL);
	}

	public function update($record_id)
	{
		$this->process($record_id);
	}

	private function process($record_id)
	{	
		// If account_id is set then we are updating a current account
		if (isset($record_id)) {
			// Setup form display name and post location
			$action = "Update";
			$data['action'] = "$action/$record_id";
			// Query db for account information based on ID provided in URI
			$query = $this->db->get_where('Account', array('id' => $record_id));
			// Put this data into 'account' array for form.php to read
			$data['account'] = $query->row_array(); 
		}
		else
		{ 
	  		$action="Add"; 
	  		$data['action'] = "$action";
	  		$data['account']= NULL; 
	  	}
		
		// Does form pass validation checks?
		if ($this->account_model->validate() == FALSE)
			{
				// Generate error to be displayed
				$form_error = validation_errors();
				if ( $form_error != "" ) { $data['error'] = $form_error; }
				
				$data['title'] = "$action Account";
				$data['submit_name'] = "$action Account";
				
				// If the page has been POSTed then set 'account' array with this data. Will overwrite db values if present.
				if ($_POST) { $data['account'] = $this->input->post('data'); } 

				$this->load->view('templates/header', $data);
				$this->load->view('account/form', $data);
				$this->load->view('templates/footer');
			}
		else
		{
			 // Put POSTed data into array
			 $data = $this->input->post('data');
			 if (isset($record_id))
			 {
			 	 // Update existing account
			 	 $this->account_model->update_account($data, $record_id);
				 $this->session->set_flashdata('message', 'Account updated');
			 }
			 else 
			 {
			 	// Add new account
			 	$data = array_merge ((array)$data, array ('code'=>uniqid("",true)));
		      	$record_id = $this->account_model->add_account($data);
			    $this->session->set_flashdata('message', 'Account added to database');
			}
			 redirect("/account/view/$record_id");
		}
	}
}
?>