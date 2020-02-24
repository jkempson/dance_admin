<?php
class Account_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_account($account_id)
	{
		$query   = $this->db->get_where('Account', array('id' => $account_id));
		return $query->row_array();
	}
	
	public function add_account($data)
	{
		if (isset($data))
		{
			$this->db->insert('Account',$data);
		}
		return $this->db->insert_id();
	}
		
	public function update_account($data, $id)
	{
		if (isset($data))
		{
			$this->db->where('id', $id);
			$this->db->update('Account', $data); 
		}
	}
	
	public function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('data[first_name]', 'First name(s)', 'trim|required');
		$this->form_validation->set_rules('data[surname]', 'Surname', 'trim|required');
		$this->form_validation->set_rules('data[address_street]', 'Street', 'trim|required');
		$this->form_validation->set_rules('data[city]', 'City', 'trim|required');
		$this->form_validation->set_rules('data[postcode]', 'Postcode', 'trim');
		$this->form_validation->set_rules('data[email]', 'Email', 'trim');
		$this->form_validation->set_rules('data[phone_1]', 'Phone number', 'trim');
		$this->form_validation->set_rules('data[phone_2]', 'Emergency number', 'trim');
		return $this->form_validation->run();
	}
	
}
