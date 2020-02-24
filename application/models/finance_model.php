<?php

class Finance_model extends CI_Model
{
 	public function __construct()
	{
		$this->load->database();
	}
	
	public function payment($data)
	{
		$this->db->insert('Bal_Payments',$data);
	}
		
	public function charge($data)
	{
		$this->db->insert('Bal_Charges',$data);
	}
	
	public function accountbalance($account_id)
	{
		$query = $this->db->query("SELECT SUM(paid) AS balance FROM view_balance_sheet WHERE account_id=$account_id");
		$result = $query->row_array();
		if ($result['balance'] != "")
		{
			return $result['balance'];
		}
		else {
			return "0.00";
		}
	}
	public function invoiceterm($term_id)
	{
            $query=$this->db->query("SELECT * FROM Term WHERE id='$term_id'");
            $result = $query->row_array();
            
            $var_term_name = $result['name'];
            $var_term_class_count = $result['class_count'];
            $var_term_start_date = $result['start_date'];
            
            //print "Generating invoices for term $var_term_name:<br>";
            $query=$this->db->query("SELECT * FROM view_register");
            $total_payments_due = 0;
            
            foreach ($query->result_array() as $row) {
                $payment_due = $row['cost'] * $var_term_class_count;
                //print sprintf("%s %s - %s = &pound;%s<br>",$row['Pupil_first_name'],$row['Pupil_surname'],$row['Classes_name'],$payment_due);
                $sql = sprintf("SELECT * FROM Bal_Classes WHERE pupil_id=%s AND account_id=%s AND term_id=%s AND class_id=%s",$row['pupil_id'],$row['account_id'],$term_id,$row['class_id']);
                $dupcheck = $this->db->query($sql);
                //print $sql." = ".$dupcheck->num_rows() ."<br>";
                $invoiceDesc = $row['Pupil_first_name']." ".$row['Pupil_surname'].", ".$row['Classes_name']." for Term ".$var_term_name." (".$var_term_class_count." classes x ".$row['cost'].") @ ".$row['Venue_name'];
                if ($dupcheck->num_rows() > 0) { 
                    $sql = sprintf("UPDATE Bal_Classes SET date=%s,description=%s,paid=%s WHERE pupil_id=%s AND account_id=%s AND term_id=%s AND class_id=%s",
                        $this->db->escape($var_term_start_date),
                        $this->db->escape($invoiceDesc),
                        $this->db->escape($payment_due),
                        $this->db->escape($row['pupil_id']),
                        $this->db->escape($row['account_id']),
                        $this->db->escape($term_id),
                        $this->db->escape($row['class_id']));
                } else { 
                    $sql = sprintf("INSERT INTO Bal_Classes SET pupil_id=%s,account_id=%s,term_id=%s,class_id=%s,date=%s,description=%s,paid=%s",
                    $this->db->escape($row['pupil_id']),
                    $this->db->escape($row['account_id']),
                    $this->db->escape($term_id),
                    $this->db->escape($row['class_id']),
                    $this->db->escape($var_term_start_date),
                    $this->db->escape($invoiceDesc),
                    $this->db->escape($payment_due));
                }
                $total_payments_due = $total_payments_due + $payment_due;
                $query=$this->db->query($sql);
                $query=$this->db->query("UPDATE Term SET invoiced='1' WHERE id='$term_id'");
            }
        return $total_payments_due;
	}

}
?>