<?php
if (isset($records)) {
	 print "<span class='graytitle'>Search results for '$query'...</span><br>";
	foreach ($records as $record)
	{
	   	print sprintf("<ul class='pageitem'><li class='menu'><a href='account/view/%s'><span class='name' style='font-size:12px;'>Account: %s %s</span><span class='arrow'></span></a></li>",
	   	$record->Account_id,$record->Account_firstname,$record->Account_surname);
	   	print sprintf("<li class='menu'><a href='account/managepupils/%s'><span class='name' style='font-size:12px;'>Pupil: %s %s</span><span class='arrow'></span></a></li>",
	   	$record->Account_id,$record->Pupil_first_name,$record->Pupil_surname);
	   	print "</ul>";
	}
} else {
	print "<br><ul class='pageitem'><li class='textbox'><span class='name'>Type * to show all records</span></li></ul>";
}
?>