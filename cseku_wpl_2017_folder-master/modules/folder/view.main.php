<?php

include_once 'blade/view.file.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>File CRUD Operations</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

<body>
<center>
	<div id="header">
		<label>By : Kazi Masudul Alam</a></label>
	</div>

	
<div id="notification">
	<table width="100%" border="1" cellpadding="15" align="center">
	<tr>
		<td>name</td>
		<td>description</td>
		<td></td>
	</tr>

	<tr>
		<td>login.php</td>
		<td>the user can login from here.</td>
		<td><a href="view.login.php">go</a></td>
	</tr>
	<tr>
		<td>file.php</td>
		<td>all files are shown that will read from database.</td>
		<td><a href="view.file.php">go</a></td>
	</tr>
	<tr>
		<td>log.php</td>
		<td>all file log shown in here</td>
		<td><a href="view.log.php">go</a></td>
	</tr>
	
	<tr>
		<td>notification.php</td>
		<td>all notification comes here,</td>
		<td><a href="view.notification.php">go</a></td>
	</tr>
	<tr>
		<td>status.php</td>
		<td>all file that are seen shown in here</td>
		<td><a href="view.status.php">go</a></td>
	</tr>
	<tr>
		<td>share.php</td>
		<td>share a file to another from here.</td>
		<td><a href="view.share.php">go</a></td>
	</tr>




	</table>
</div>
</center>
</body>
</html>