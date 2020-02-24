<?php
class Pupil_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function delclass($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('Register'); 
	}
	
	public function addclass($data)
	{
		$this->db->insert('Register',$data);
	}
	
	public function add($data)
	{
		if (isset($data))
		{
			$this->db->insert('Pupil',$data);
		}
	}
	
	public function update($data, $id)
	{
		if (isset($data))
		{
			$this->db->where('id', $id);
			$this->db->update('Pupil', $data); 
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('Pupil'); 
	}
	
	public function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('data[first_name]', 'First name(s)', 'trim|required');
		$this->form_validation->set_rules('data[surname]', 'Surname', 'trim|required');
		$this->form_validation->set_rules('data[dob]', 'Date of birth', 'trim');
		$this->form_validation->set_rules('data[enrolment]', 'Enrolment date', 'trim');
	
		return $this->form_validation->run();
	}
	
}
