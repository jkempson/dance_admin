<?php echo form_open("$action"); ?>

		<fieldset>
		<span class="graytitle">Select recipients</span>
		<ul class="pageitem">
		<li class = 'select'>
		<select name='recipients'>
                        <option value='0'>Active accounts</option>
			<option value='1'>ALL accounts</option>
			<option value='2'>Outstanding payments</option>
			<option value='3'>Class</option>
			<option value='4'>Venue</option>
		</select>
		<span class="arrow"></span>
		</li>
		</ul>
		
		<ul class="pageitem">
			<li class="button">
			<?php echo form_submit('submit', "Select"); ?>
			</li>
		</ul>
		
	</fieldset></form>
