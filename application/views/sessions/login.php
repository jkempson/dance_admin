<?php echo form_open("sessions/authenticate"); ?>
	<fieldset>
		<ul class="pageitem">

			<li class='bigfield'>
			<?php echo form_input(array('name' => 'user[name]','id' => 'user_name', 'placeholder' => 'Username', 'autocapitalize'=>'Off', 'autocorrect'=>'Off', 'value'=>$username)); ?>
			</li>
			<li class='bigfield'>
			<?php echo form_password(array('name' => 'user[password]','id' => 'user_password', 'placeholder' => 'Password')); ?>
			</li>

		</ul>
		
		<ul class="pageitem">
			<li class="button">
			<?php echo form_submit('submit', 'Login'); ?>
			</li>
		</ul>		
	</fieldset>
<?php echo form_close(); ?>
