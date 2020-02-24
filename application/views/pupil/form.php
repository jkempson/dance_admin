<?php echo form_open("pupil/$action"); ?>
	<fieldset>
		<span class="graytitle">Name</span>
		<ul class="pageitem">
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[first_name]',
									 	'id' => 'first_name', 
									 	'placeholder' => 'First name(s)', 
									 	'autocorrect'=>'off', 
									 	'value'=>$pupil['first_name'])); 
									 	?>
			</li>
			<li class='bigfield'>
			<?php echo form_input( array ( 'name' => 'data[surname]',
									  	'id' => 'surname',
									  	'placeholder' => 'Surname',
									  	'autocorrect' => 'off',
									  	'value' => $pupil['surname'])); 
									  	?>
			</li>
		</ul>
		
		
		<span class="graytitle">Details</span>
		<ul class="pageitem">
			<li class='smallfield'><span class='name'>Date of Birth</span>
			<?php echo form_input( array ( 'name' => 'data[dob]',
									 	'id' => 'dob', 
									 	'type'=>'date', 
									 	'value'=>$pupil['dob'])); 
									 	?>
			</li>
			<li class='smallfield'><span class='name'>Enrolment</span>
			<?php echo form_input( array ( 'name' => 'data[enrolment]',
									 	'id' => 'enrolment', 
									 	'type'=>'date', 
									 	'value'=>$pupil['enrolment'])); 
									 	?>
			</li>
		</ul>


		<ul class="pageitem">
			<li class="button">
			<?php echo form_submit('submit', $submit_name); ?>
			</li>
		</ul>
		<?php if ($pupil['account_id'] != "") { ?>
		<ul class="pageitem">
		<li class='menu'><a href="pupil/delete/<?php echo $pupil['id']?>/<?php echo $pupil['account_id']?>"><span class="name">Delete Pupil</span><span class="arrow"></span></a></li>
		</ul>
		<?php } ?>
		
	</fieldset></form>
