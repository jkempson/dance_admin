
<?php echo form_open("account/$action"); ?>

		<fieldset>
		<span class="graytitle">Name</span>
		<ul class="pageitem">
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[first_name]',
									 	'id' => 'first_name', 
									 	'placeholder' => 'First name(s)', 
									 	'autocorrect'=>'off', 
									 	'value'=>$account['first_name'])); 
									 	?>
			</li>
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[surname]',
									  	'id' => 'surname',
									  	'placeholder' => 'Surname',
									  	'autocorrect' => 'off',
									  	'value' => $account['surname'])); 
									  	?>
			</li>
		</ul>
		<span class="graytitle">Address</span>
		<ul class="pageitem">
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[address_street]',
										'id' => 'address_street',
										'placeholder' => 'Street',
										'autocorrect'=>'off',
										'value' =>$account['address_street'])); 
										?>
			</li>
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[city]',
										'id' => 'city',
										'placeholder' => 'City',
										'autocorrect'=>'off',
										'value' =>$account['city']));
										?>
			</li>
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[postcode]',
										'id' => 'postcode',
										'placeholder' => 'Postcode',
										'autocorrect'=>'off',
										'value' =>$account['postcode']));
										?>
			</li>
		</ul>
		<span class="graytitle">Contact</span>
		<ul class="pageitem">
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[email]',
										'id' => 'email',
										'placeholder' => 'Email',
										'type'=>'email',
										'value' =>$account['email']));
										?>
			</li>
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[phone_1]',
										'id' => 'phone_1',
										'placeholder' => 'Phone number',
										'type'=>'tel',
										'value' => $account['phone_1']));
										?>
			</li>
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[phone_2]',
										'id' => 'phone_2',
										'placeholder' => 'Emergency number',
										'type'=>'tel',
										'value' => $account['phone_2']));
										?>
			</li>
		</ul>
		<span class="graytitle">Notes</span>
		<ul class="pageitem">
			<li class='textbox'>
			<span class='header'>Add an account note</span>
			<?php echo form_textarea(array('name' => 'data[notes]','id' => 'notes', 'rows'=>'4', 'value'=>$account['notes'])); ?>
			</li>
		</ul>

		<ul class="pageitem">
			<li class="button">
			<?php echo form_submit('submit', $submit_name); ?>
			</li>
		</ul>
		
	</fieldset></form>
