<?php
$query = $this->db->get('view_classes');
$classes = $query->result_array(); 
$query = $this->db->get_where('Term', array('id' => $term));
$term = $query->row_array();
$term['start_date']=date("jS F Y", strtotime($term['start_date']));
$term['end_date']=date("jS F Y", strtotime($term['end_date']));
$count_class = 0;
if ($blankrows > 20) { $blankrows=20; }
?>
<html>
<head>
<style type="text/css">
p {font-family:Arial,Helvetica,sans-serif;}
table {border-collapse: collapse;border: 1px solid #000;}
table th, table td {border: 1px solid #000; font-family:Arial,Helvetica,sans-serif;}
</style>
</head>
<body>

<?php foreach ($classes as $class) { ?>
	<p align="centre">
		<img width="200" src="assets/pics/invoicelogo.png"><br><b>Forth Dance Academy Register</b>
	</p>
	<hr>
	<p>
		<b>Class:</b> <?php echo $class['Classes_name']?> (<?php echo $class['day']?> @ <?php echo substr($class['time'],0,-3)?>)<br/>
		<b>Venue:</b> <?php echo $class['Venue_name']?><br/>
		<b>Term:</b> <?php echo $term['name']?> (<?php echo $term['start_date']?> to <?php echo $term['end_date']?>)
	</p>
	<hr><br/>
		<table width="100%" cellpadding="3">
		<thead><tr>
		<th align="left">Name</th>
		<th>Paid</th>
		<?php
		for ($i=1; $i<=$term['class_count']; $i++) { print "<th>Week $i</th>"; }
		?>
		</thead></tr><tbody>
		<?php
		$query = $this->db->get_where('view_register', array('class_id' => $class['Classes_id']));
		$pupils = $query->result_array(); 
		foreach ($pupils as $pupil) {
			print "<tr><td>".$pupil['Pupil_first_name']." ".$pupil['Pupil_surname']."</td>";
			for ($i=1; $i<=$term['class_count'] + 1; $i++) { print "<td></td>"; }
			print "</tr>";
		}
		
		for ($i=1; $i<=$blankrows; $i++) { 
			print "<tr><td>&nbsp;</td>";
			for ($a=1; $a<=$term['class_count'] + 1; $a++) { print "<td></td>"; }
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
