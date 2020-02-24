<?php
if (count($pupils) > 0) {
	?>
	<span class='graytitle'><?php echo $pupils[0]['Classes_name'].", ".$pupils[0]['day']." ".$pupils[0]['time']." @ ".$pupils[0]['Venue_name']?></span><br>
	<ul class='pageitem'>
	<?php foreach ($pupils as $pupil) { ?>
		<li class='menu'><a href='account/managepupils/<?php echo $pupil['account_id']?>'><span class='name'><?php echo $pupil['Pupil_first_name']." ".$pupil['Pupil_surname']?><span class='arrow'></span></a></span></li>
	<?php } ?>
	</ul>
	<?php
	} else {
	?>
        <span class='graytitle'>No pupils in this class</span><br>
<?php
}
?>


