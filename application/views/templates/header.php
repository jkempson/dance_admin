<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<base href="https://forthdanceacademy.com/admin/"/> 
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />

<link href="https://forthdanceacademy.com/admin/assets/pics/homescreen.gif" rel="apple-touch-icon" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="assets/css/style.css" rel="stylesheet" media="screen" type="text/css" />
<script src="assets/javascript/functions.js" type="text/javascript"></script>
<link href="https://forthdanceacademy.com/admin/assets/pics/startup.png" rel="apple-touch-startup-image" />
<title>Forth Dance Academy</title>
</head>
<style type="text/css">
div#title { text-align : right; }
</style>


<div id="topbar">
	<div id="leftnav">
		<?php if (!isset($hidehome)) { 
		print '<a href="home"><img alt="home" src="assets/images/home.png" /></a><a href="javascript:history.go(-1)">Back</a>';
		 } ?>
	</div>
	<div id='title'><?php echo $title?></div> 
</div>

<?php if (isset($searchbox)) { ?> 
	<div  class="searchbox">
	<?php echo form_open($searchbox); ?>
		<fieldset><input name="query" placeholder="search" type="text" autocorrect="off" autocapitalize="off" />
		<input id="submit" type="hidden" /></fieldset>
	</form>
	</div>
<?php } ?>

<div id="content">

<?php
$fd = $this->session->flashdata('message');
if ($fd!="") 
{ 
	print "<ul class='pageitem'><li class='textbox'><b>Information:</b><br>$fd</li></ul>";
}

if (isset($error)) 
{ 
	print "<ul class='pageitem'><li class='textbox'><b>Error:</b>$error</li></ul>";
}


?>
