<?php

class Mail_model extends CI_Model
{
	 public function sendEmail($to,$subject="",$body="") {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'tls://email-smtp.eu-west-1.amazonaws.com',
			'smtp_port' => 465,
			'smtp_user' => 'AKIAJEOAI54GQVDSMU5A',
			'smtp_pass' => 'AscTcfvegpHMomK/WJjVkDf0/w8GqdAg6v4w7ENNvdqn',
			'mailtype'  => 'text', 
			'charset'   => 'iso-8859-1'
		);
		
		$this->load->library('email', $config);
		$this->email->from('heather@forthdanceacademy.com','Heather McKendry [Forth Dance Academy]');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);	
		$this->email->set_newline("\r\n");
		return $this->email->send();
		}
}
?>