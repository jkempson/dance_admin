
<?php echo form_open("$action"); ?>
<?php echo form_hidden("recipients", $recipients); ?>

		<fieldset>
		<span class="graytitle">Select class</span>
		<ul class="pageitem">
		<li class = 'select'>
		<select name='subgroup'>
		
		<?php
				$this->db->select('*')->from('view_classes')->order_by('Classes_name');
				$classes = $this->db->get();				
				if (isset($classes))
				{
					foreach ($classes->result() as $class)
					{
					?>
					<option value='<?php echo $class->Classes_id?>'><?php echo $class->Classes_name?> at <?php echo $class->Venue_name?></option>
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
