
<?php echo form_open("$action"); ?>

		<fieldset>
		<span class="graytitle">Select term</span>
		<ul class="pageitem">
		<li class = 'select'>
		<select name='subgroup'>
		
		<?php
                                $query=$this->db->query("SELECT * FROM Term WHERE invoiced=$old_term ORDER BY start_date");
                                foreach ($query->result_array() as $term)
                                    {
                                    ?>
                                    <option value='<?php echo $term['id']?>'><?php echo $term['start_date']?> to <?php echo $term['end_date']?></option>
                                    <?php 
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
