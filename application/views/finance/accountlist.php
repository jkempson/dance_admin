<ul class='pageitem'>
<li class='menu'><a href='finance/dueinvoices/pdf'><span class='name'>Create PDF Invoices</span><span class='arrow'></span></a>
</ul>

<ul class='pageitem'>

<?php 
	foreach ($accounts as $account) {
	$query = $this->db->get_where('Account', array('id' => $account));
	$details = $query->row_array();
	$query = $this->db->query("SELECT SUM(paid) AS balance FROM view_balance_sheet WHERE account_id=$account");
	$status = $query->row_array();
?>

<li class='menu'><a href='account/view/<?php echo $account?>'><span class='name' style="font-size:12px;"><?php echo$details['first_name']?> <?php echo $details['surname']?> - £<?php echo $status['balance']?>, invoice seen: <?php echo $details['invoice_seen']?></span><span class='arrow'></span></a>

<?php } ?>
</ul>