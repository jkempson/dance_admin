<?php
$query = $this->db->get('view_classes');
$classes = $query->result_array(); 
$count_class = 0;
?>
<html>
<head>
<style type="text/css">
p {font-family:Arial,Helvetica,sans-serif;}
table {border-collapse: collapse;border: 1px solid #000; }
table th, table td {border: 1px solid #000; font-family:Arial,Helvetica,sans-serif; font-size: 12px;}
</style>
</head>
<body>

<?php foreach ($classes as $class) { ?>
	<p align="centre">
		<img width="200" src="assets/pics/invoicelogo.png"><br><b>Emergency Contact List</b>
	</p>
	<hr>
	<p>
		<b>Class:</b> <?php echo $class['Classes_name']?> (<?php echo $class['day']?> @ <?php echo substr($class['time'],0,-3)?>)<br/>
		<b>Venue:</b> <?php echo $class['Venue_name']?><br/>
	</p>
	<hr><br/>
		<table width="100%" cellpadding="3">
		<thead><tr>
		<th align="left">Name</th>
		<th align="left">Contact Name</th>
		<th align="left">Phone</th>
		<th align="left">Emergency Phone</th>
		<th align="left">Email</th>
		<th align="left">Account notes</th>

		</thead></tr><tbody>
		<?php
		
		$query = $this->db->get_where('view_register', array('class_id' => $class['Classes_id']));
		$pupils = $query->result_array(); 
		foreach ($pupils as $pupil) {
			print "<tr><td valign='top'>".$pupil['Pupil_first_name']." ".$pupil['Pupil_surname']."</td>";
			print "<td valign='top'>".$pupil['Account_firstname']." ".$pupil['Account_surname']."</td>";
			print "<td valign='top'>".$pupil['phone_1']."</td>";
			print "<td valign='top'>".$pupil['phone_2']."</td>";
			print "<td valign='top'>".$pupil['email']."</td>";
			print "<td  valign='top' width='33%'>".$pupil['Account_notes']."</td>";
			print "</tr>";
		}

		?>
		</table>
<?php 
	if (++$count_class != count($classes)) { print "<div style='page-break-before: always;'></div>"; }
}
?>
</body>
</html>
