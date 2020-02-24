
<?php echo form_open("$action"); ?>

		<fieldset>
		<span class="graytitle">Select term</span>
		<ul class="pageitem">
		<li class = 'select'>
		<select name='term'>
		<?php
				$terms = $this->db->get('Term');
				if (isset($terms))
				{
					foreach ($terms->result() as $term)
					{
					?>
					<option value='<?php echo $term->id?>'><?php echo $term->name?> (<?php echo $term->start_date?> to <?php echo $term->end_date?>), <?=$term->class_count?> classes</option>
					<?php
					}
				}
		?>
		</select>
		<span class="arrow"></span>
		</li>
		</ul>

		<span class="graytitle">Blank rows per register</span>
		<ul class="pageitem">
		<li class='bigfield'><input name='blankrows' placeholder='rows' value='0' type='tel'/></li>
		</ul>
		
		<ul class="pageitem">
			<li class="button">
			<?php echo form_submit('submit', $submit_name); ?>
			</li>
		</ul>
		
	</fieldset></form>
