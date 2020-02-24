<?php
class Pupil extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pupil_model');
	}
	
	public function viewclass()
	{
		$class_id = $this->input->get_post('class');
		if ($class_id != "")
		{
			$query = $this->db->get_where('view_register', array('class_id' => $class_id));
			$data['pupils'] = $query->result_array(); 
			
			$data['title'] = "Class List";
			$this->load->view('templates/header', $data);
			$this->load->view('pupil/viewclass',$data);
		}
		else 
		{
			$data['title'] = "Choose Class";
			$data['submit_name'] = "View Class";
			$data['action'] = "pupil/viewclass";
			
			$this->load->view('templates/header', $data);
			$this->load->view('pupil/class', $data);
		}
		$this->load->view('templates/footer');
	}
	
	public function delclass($register_id = NULL, $account_id = NULL) 
	{
		$this->session->set_flashdata('message', 'Class deleted');
		$this->pupil_model->delclass($register_id);
		redirect("/account/managepupils/$account_id");
	}
	
	public function addclass($pupil_id = NULL, $account_id = NULL )
	{
		$data['title'] = "Choose Class";
		$this->load->view('templates/header', $data);
		$class_id = $this->input->get_post('class');
		if ($class_id != "") {

			$sql = array
			(
				'pupil_id'  => $pupil_id,
				'class_id'  => $class_id,
				'account_id'=> $account_id
			);

			$this->pupil_model->addclass($sql);
			$this->session->set_flashdata('message', 'Class added to pupil');
			redirect("/account/managepupils/$account_id");
		} else {
			$data['submit_name'] = "Add pupil to class";
			$data['action']="pupil/addclass/$pupil_id/$account_id";
			$this->load->view('pupil/class', $data);
		}
		$this->load->view('templates/footer');

	}
	
	public function delete($record_id=NULL, $account_id=NULL)
	{
		if (isset($record_id))
		{
			$this->pupil_model->delete($record_id);
			$this->session->set_flashdata('message', 'Pupil deleted');
			redirect("/account/managepupils/$account_id");
		}
	}
	
	public function add($account_id = NULL)
	{
		if (isset($account_id)) {
			$this->process(NULL,$account_id);
		}
	}

	public function update($record_id = NULL, $account_id = NULL )
	{
		if ((isset($account_id)) && (isset($record_id))) {
			$this->process($record_id, $account_id);
		}
	}

	private function process($record_id, $account_id)
	{	
		// If record_id is set then we are updating a current pupil
		if (isset($record_id)) {
			// Setup form display name and post location
			$action = "Update";
			$data['action'] = "$action/$record_id/$account_id";
			// Query db for pupil information based on ID provided in URI
			$query = $this->db->get_where('Pupil', array('id' => $record_id));
			// Put this data into 'pupil' array for form.php to read
			$data['pupil'] = $query->row_array(); 
		}
		else
		{ 
	  		$action="Add"; 
	  		$data['action'] = "$action/$account_id";
	  		$data['pupil']= NULL; 
	  	}
		
		// Does form pass validation checks?
		if ($this->pupil_model->validate() == FALSE)
			{
				// Generate error to be displayed
				$form_error = validation_errors();
				if ( $form_error != "" ) { $data['error'] = $form_error; }
				$data['title'] = "$action Pupil";
				$data['submit_name'] = "$action Pupil";
				
				// If the page has been POSTed then set 'pupil' array with this data. Will overwrite db values if present.
				if ($_POST) { $data['pupil'] = $this->input->post('data'); } 

				$this->load->view('templates/header', $data);
				$this->load->view('pupil/form', $data);
				$this->load->view('templates/footer');
			}
		else
		{
			 // Put POSTed data into array
			 $data = $this->input->post('data');
			 if (isset($record_id))
			 {
			 	 // Update existing account
			 	 $this->pupil_model->update($data, $record_id);
				 $this->session->set_flashdata('message', 'Pupil updated');
			 }
			 else 
			 {
			 	// Add new account
			    $data['account_id']=$account_id;
		      	$this->pupil_model->add($data,$account_id);
			    $this->session->set_flashdata('message', 'Pupil added to database');
			}
			 redirect("/account/managepupils/$account_id");
		}
	}
}
?>