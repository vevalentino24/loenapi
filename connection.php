<?php
	$host = "localhost";
	$user = "root";
	$pass = ""; 
	$db = "loenpia";

	mysql_connect($host, $user, $pass) or die("Connection Failed".mysql_error());
	mysql_select_db($db) or die("Database Not Found".mysql_error());
?>
