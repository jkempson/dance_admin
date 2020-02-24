
<?php echo form_open("$action"); ?>

		<fieldset>
		<ul class="pageitem">
		<li class = 'select'>
		<select name='class'>
		<?php
			    $this->db->order_by("Classes_name asc, Venue_id asc");  
				$classes = $this->db->get('view_classes');
				if (isset($classes))
				{
					foreach ($classes->result() as $class)
					{
					?>
					<option value='<?php echo $class->Classes_id?>'><?php echo $class->Classes_name.", ".$class->day." ".$class->time." @ ".$class->Venue_name ?></option>
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
			<?php echo form_submit('submit', $submit_name); ?>
			</li>
		</ul>
		
	</fieldset></form>