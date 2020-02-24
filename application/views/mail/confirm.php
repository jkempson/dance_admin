<?php echo form_open("$action"); ?>
			<?php echo form_hidden("sent","1"); ?>
			<?php echo form_hidden("recipients", $recipients); ?>
			<?php echo form_hidden("body",$body); ?>
			<?php echo form_hidden("subject",$subject); ?>

			<?php if (isset($subgroup)) { echo form_hidden("subgroup", $subgroup); } ?>

		<fieldset>
		<span class="graytitle">Select recipients</span>
		<ul class="pageitem">
	
		<?php
			$i = 0;
			foreach ($acclist as $acc) {
				print "<li class='checkbox'>$acc<input type='checkbox' name='confirmed[]' value='$accid[$i]' checked/></li>";
				$i++;
			}
		?>
		<span class="arrow"></span>
		</ul>
		
		<ul class="pageitem">
			<li class="button">
			<?php echo form_submit('submit', "Send to selected accounts"); ?>
			</li>
		</ul>
		
	</fieldset></form>
