<?php
$count=0;
?>
<html>
<head>
<style type="text/css">
p {
    font-family:Arial,Helvetica,sans-serif;
}
table {
    border-collapse: collapse;
}
table th, table td {
    font-family:Arial,Helvetica,sans-serif;
    font-size:small;
}
</style>
</head>
<body>
<?php 
	$rec_count=1;
	foreach($accounts AS $account) {
    $query = $this->db->get_where('Account', array('id' => $account));
    $details = $query->row_array();
    ?>
    <table width="100%"><tr>
    <td align="left" valign="top" width="100%"><p>
    <b><?php echo $details['first_name']." ".$details['surname']?></b><br/>
    <?php echo $details['address_street']?><br/>
    <?php echo $details['city']?><br/>
    <?php echo $details['postcode']?>
    </p></td>
    <td align="center" valign="top">
    <p><img width="200" src="assets/pics/invoicelogo.png"><br>forthdanceacademy.com</p>
    </td>
    </tr></table>
    <hr>
    <center><p><b>ACCOUNT SUMMARY<b></p></center>
    <hr>
    <table width="100%">
    <?php
    $query = $this->db->query("SELECT SUM(paid) AS balance FROM view_balance_sheet WHERE account_id=$account");
    $status = $query->row_array();
    $this->db->order_by("date", "asc");
    $query = $this->db->get_where('view_balance_sheet', array('account_id' => $account));
    $items = $query->result_array();
    
    $cum_balance = 0;
    $count = 0;
    $inv_start = 0;
    foreach($items as $item) {
	    $cum_balance = $cum_balance + $item['paid'];
	    if ($cum_balance == 0) { $inv_start = $count+1; }
	    $count++;
    }
    
    $i=0;
    foreach($items as $item) {
	    if ($i >= $inv_start) {
	        $item['date'] = date("d/m/y", strtotime($item['date']));
	        	        
	        if ($item['paytype'] != "due") {
	            
	            switch ($item['paytype']) {
		            case "payment" : $d = "Thank you, payment received"; break;
		            case "charge" : $d = "Charge"; break;
		            case "refund" : $d = "Account refunded"; break;
	            }

	            if ($item['description'] != "") {
	                $d = "$d (".$item['description'].")";
	            }
	            $item['description'] = $d;
	        }
	        ?>
	        <tr>
	        <td valign="top"><?php echo $item['date']?></td>
	        <td valign="top"><?php echo $item['description']?><br/><br/></td>
	        <td valign="top" align="right">&pound;<?php echo $item['paid']?></td>
	        </tr>
	        <?php
	    }
	    $i++;
    }
    
    ?>
    <tr>
    <td></td>
    <td valign="top" align="right"><b>Amount due:<b></td>
    <td valign="top" align="right"><b>&pound;<?php echo $status['balance']?></b></td>
    </tr>
    </table>
    <br/><hr>
    <center><p>Please make cheques payable to "Miss Heather McKendry"</p></center>
    <p><i>Invoices will be issued at the start of each term. The balance must be settled within 7 days to avoid a &pound;5 late payment penalty. Classes are paid for in advance and any classes missed are non-refundable.</i></p>
    <?php
    if ($rec_count < count($accounts)) {
        print "<div style='page-break-before: always;'></div>";
    }
    $rec_count++;
}
?>

</body>
</html>