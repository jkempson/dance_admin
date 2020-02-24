
<?php echo form_open("$action"); ?>
<?php echo form_hidden("recipients", $recipients); ?>

		<fieldset>
		<span class="graytitle">Select venue</span>
		<ul class="pageitem">
		<li class = 'select'>
		<select name='subgroup'>
		
		<?php
				$this->db->select('*')->from('Venue')->order_by('name');
				$venues = $this->db->get();				
				if (isset($venues))
				{
					foreach ($venues->result() as $venue)
					{
					?>
					<option value='<?php echo $venue->id?>'><?php echo $venue->name?></option>
					<?php	
					}
				}
		?>
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
