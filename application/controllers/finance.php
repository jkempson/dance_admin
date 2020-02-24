<?php
class Finance extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('finance_model');
	}
	
	public function invoiceterm() {
            $id = end($this->uri->segments);
            if (isset($id) && ($id==1)) { $data['old_term'] = 1; } else { $data['old_term'] = 0; }
            $submit_action = $this->input->post('submit');

            if ($submit_action == "") {
                $data['action'] = "finance/invoiceterm/";
                $this->load->view('templates/header', array('title' => 'Invoice Term'));
                $this->load->view('finance/termlist', $data);
                $this->load->view('templates/footer');
            } else {
                $term_id = $this->input->post('subgroup');
                $this->load->view('templates/header', array('title' => 'Invoice Term'));
                $data['payment_due'] = $this->finance_model->invoiceterm($term_id);
                $this->load->view('finance/invoicedone', $data);
                $this->load->view('templates/footer');            }
	}
	
	public function charge($account_id = NULL) {
		$data = $this->input->post('data');
		if (($data['payment'] !="" ) && (isset($account_id))) {
			$sql = array
			(
				'account_id'  => $account_id,
				'date'  => $data['paydate'],
				'description' => $data['paynote'],
				'paid' => $data['payment']
			);
			$this->finance_model->charge($sql);
			redirect("/finance/paymentlist/$account_id");
		} else {
			$data['submit_name'] = "Submit";
			$data['action'] = "finance/charge/$account_id";
			$this->load->view('templates/header', array('title' => 'Charge Account'));
			$this->load->view('finance/payment', $data);
			$this->load->view('templates/footer');
		}
	}
	
	public function editpayment($type, $trans)
	{
		$table = "Bal_Payments";
		if ($type=="due") { $table = "Bal_Classes"; }
		if ($type=="charge") { $table = "Bal_Charges"; }
		
		$submit_action = $this->input->post('submit');
		if ( $submit_action != "" )
		{
			$query   = $this->db->get_where($table, array('id' => $trans));
			$result = $query->row();
			
			$this->db->where('id', $trans);
			if ($submit_action != "Delete") {
				$post = $this->input->post('data');
			    $data = array (
				    'description'   => $post['paynote'],
				    'date'  		=> $post['paydate'],
				    'paid'    		=> $post['payment']
				    );
			    $this->db->update($table, $data); 
			} else {
			    $this->db->delete($table); 
			} 
			redirect("/finance/paymentlist/".$result->account_id);
		} else {

			$query   = $this->db->get_where($table, array('id' => $trans));
			$data['payment'] = $query->row_array();
	
			$data['action'] = "finance/editpayment/$type/$trans";
			$data['submit_name'] = "Update";
			$data['type']=$type;
			//$data['payname'] = ($type == "due") ? "Charge": "Payment";
			
			$this->load->view('templates/header', array('title' => "Edit ".(($type == "due") ? "Charge": "Payment")));
			$this->load->view('finance/payment', $data);
			$this->load->view('templates/footer');
		}
	}
	
	public function paymentlist($account_id=NULL)
	{
		$this->load->model('account_model');

		$this->db->order_by("date", "desc");  
		$query   = $this->db->get_where('view_balance_sheet', array('account_id' => $account_id));
		$data['payments'] = $query->result_array();
		$data['account'] = $this->account_model->get_account($account_id);
		$data['balance'] = $this->finance_model->accountbalance($account_id);
		$this->load->view('templates/header', array('title' => 'Payment History'));
		$this->load->view('finance/paymentlist', $data);
		$this->load->view('templates/footer');
	}
	
	public function payment($account_id=NULL)
	{
		$data = $this->input->post('data');
		if (($data['payment'] !="" ) && (isset($account_id))) {
			$sql = array
			(
				'account_id'  => $account_id,
				'date'  => $data['paydate'],
				'description' => $data['paynote'],
				'paid' => $data['payment']
			);
			$this->finance_model->payment($sql);
			redirect("/finance/paymentlist/$account_id");
		} else {
			$data['submit_name'] = "Submit";
			$data['action'] = "finance/payment/$account_id";
			$this->load->view('templates/header', array('title' => 'Make Payment'));
			$this->load->view('finance/payment', $data);
			$this->load->view('templates/footer');
		}
	}
	
	public function dueinvoices($action = NULL)
	{
		$this->db->order_by("surname", "asc");  
		$query = $this->db->get('Account');
		$accounts = $query->result_array();	
	  	$data['accounts'] = array();
	  	foreach ($accounts as $account) {
			$balance = $this->finance_model->accountbalance($account['id']);
			if ($balance > 0) { array_push($data['accounts'], $account['id']); }
		}
		if ($action=="pdf") {
			$html = (string) $this->load->view('finance/invoice',$data,true);
			$this->load->model('pdf_model');
			$this->pdf_model->load($html, "Invoice.pdf", "portrait");
		} else {
			$data['title'] = "Due Payments";
			$this->load->view('templates/header', $data);
			$this->load->view('finance/accountlist',$data);
			$this->load->view('templates/footer');
		}
	}
	
	public function accountinvoice($account_id) {
		  $data['accounts'] = array();
		  array_push($data['accounts'], $account_id);
		  		  
		  $html = (string) $this->load->view('finance/invoice',$data,true);
		  $this->load->model('pdf_model');
		  $this->pdf_model->load($html, "Invoice.pdf", "portrait");
	}
}