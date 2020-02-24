<ul class='pageitem'>
<li class='menu'><a href='account/update/<?php echo $account['id']?>'><span class='name'><?php echo $account['first_name']." ".$account['surname']?></span><span class='arrow'></span></a></li>
<li class='textbox'>
	<span class='name'>
		<?php echo $account['address_street']?><br/>
		<?php echo $account['city']?><br/>
		<?php echo $account['postcode']?><br/>
		<a href='mailto:<?php echo $account['email']?>'><?php echo $account['email']?></a></span></li>
		<?php if ($account['notes'] != "" ) { } ?>
	</span>
</li>
<li class='textbox'>
	<span class='name'>
		<table>
		<tr>
		<td>Phone:</td><td><?php echo $account['phone_1']?></td>
		</tr><tr>
		<td>Emergency:</td><td><?php echo $account['phone_2']?></td>
		</tr>
		</table>
	</span>
</li>
<?php if ($account['notes'] != "") { ?>
<li class='textbox'>
	<span class='name'>
		<?php echo $account['notes']?><br/>
	</span>
</li>
<?php } ?>
<li class='textbox'><span class='name'>Payment due: £<?php echo $balance?></span></li>
<li class='menu'><a href='account/managepupils/<?php echo $account['id']?>'><span class='name'>Manage pupils</span><span class='arrow'></span></a>
<li class='menu'><a href='finance/paymentlist/<?php echo $account['id']?>'><span class='name'>Payments</span><span class='arrow'></span></a>
<li class='menu'><a href='finance/accountinvoice/<?php echo $account['id']?>'><span class='name'>View invoice (PDF)</span><span class='arrow'></span></a>

</ul>