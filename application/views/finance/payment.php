<?php 
echo form_open("$action");

if (!isset($payment)) {
	$payment['paid']="";
	$payment['date']=date('Y-m-d');
	$payment['description']="";
	$new=true;
} else {
	$payment['date'] = (isset($payment['date'])) ? date("Y-m-d", strtotime($payment['date'])) : date('Y-m-d');
	$new=false;
}
?>
		<fieldset>
		<ul class="pageitem">
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[payment]',
									 	'id' => 'payment', 
									 	'placeholder' => '£', 
									 	'type'=>'numeric',
									 	'value'=>$payment['paid']
									 	));
									 	?>
			</li>
			<li class='smallfield'>
			<span class='name'>Date</span>
			<?php echo form_input( array ( 'name' => 'data[paydate]',
									 	'id' => 'paydate', 
									 	'type'=>'date',
									 	'value'=>$payment['date']
									 	));
									 	?>
			</li>
			<li class='textbox'>
			<span class='header'>Note:</span>
			<?php echo form_textarea( array ( 'name' => 'data[paynote]',
									 	'id' => 'paynote', 
									 	'placeholder' => 'Note (optional)', 
									 	'type'=>'text',
									 	'value'=>$payment['description']
									 	));
									 	?>
			</li>

		</ul>
		
		<ul class="pageitem">
			<li class="button">
			<?php echo form_input( array ( 'name' => 'submit',
									 	'type'=>'submit',
									 	'value'=>$submit_name
									 	));
			?>
			</li>
		</ul>
		
		<ul class="pageitem">
			<li class="button">
			<?php echo form_input( array ( 'name' => 'submit',
									 	'type'=>'submit',
									 	'value'=>'Delete'
									 	));
			?>
			</li>
		</ul>
		
		</fieldset>