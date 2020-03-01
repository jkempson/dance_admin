<?php

class Mail_model extends CI_Model
{
	 public function sendEmail($to,$subject="",$body="") {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => '',
			'smtp_port' => 465,
			'smtp_user' => '',
			'smtp_pass' => ',
			'mailtype'  => 'text', 
			'charset'   => 'iso-8859-1'
		);
		
		$this->load->library('email', $config);
		$this->email->from('email','name');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);	
		$this->email->set_newline("\r\n");
		return $this->email->send();
		}
}
?>
