<span class='graytitle'><?php echo $account['first_name']." ".$account['surname'] ?> [Balance: £<?php echo $balance?>]</span>

<ul class='pageitem'>
<li class='menu'><a href='finance/payment/<?php echo $account['id']?>'><span class='name'>Make a payment</span><span class='arrow'></span></a></li>
<li class='menu'><a href='finance/charge/<?php echo $account['id']?>'><span class='name'>Charge account</span><span class='arrow'></span></a></li>

</ul>

<ul class='pageitem'>
<?php foreach ($payments as $payment) { 
	$payment['date'] = date("d/m/y", strtotime($payment['date']));
	$payurl = "pay";
	if ( $payment['paytype'] == "due") { $payurl="due"; }
	if ( $payment['paytype'] == "charge") { $payurl="charge"; }	
	if ($payment['paytype']=="payment") {
		$payment['paid'] = sprintf("%0.2f",-$payment['paid']);
	}

?>
	
<li class='menu'><a href="finance/editpayment/<?php echo $payurl?>/<?php echo $payment['trans_id']?>">
<span class='name' style="font-size:12px;">

<?php echo $payment['date']?> - [£<?php echo $payment['paid']." ".$payment['paytype']?>] <?php echo $payment['description']?></span><span class='arrow'></span>
</a>
</li>

<?php } ?>
</ul>

