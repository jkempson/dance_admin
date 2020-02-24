<?php echo form_open("$action"); ?>

		<fieldset>
		<span class="graytitle">Subject</span>
		<ul class="pageitem">
			<li class='bigfield'>
			<?php echo form_hidden("sent","1"); ?>
			<?php echo form_hidden("recipients", $recipients); ?>
			<?php if (isset($subgroup)) { echo form_hidden("subgroup", $subgroup); } ?>
			<?php echo form_input( array ( 'name' => 'subject',
									 	'id' => 'subject', 
									 	'placeholder' => '', 
									 	'autocorrect'=>'off', 
									 	'value'=>"$presubject")); 
									 	?>
			</li>

		</ul>
		<span class="graytitle">Message</span>
		<ul class="pageitem">
			<li class='textbox'>
			<?php echo form_textarea(array('name' => 'body','id' => 'body', 'rows'=>'12', 'value'=>"$premessage")); ?>
			</li>
		</ul>

		<ul class="pageitem">
			<li class="button">
			<?php echo form_submit('submit', "Send"); ?>
			</li>
		</ul>
		
	</fieldset></form>
