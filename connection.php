<?php
	$host = "mysql.idhostinger.com";
	$user = "u209486473_nulp";
	$pass = "tekanenter"; 
	$db = "u209486473_hpark";

	mysql_connect($host, $user, $pass) or die("Connection Failed".mysql_error());
	mysql_select_db($db) or die("Database Not Found".mysql_error());
?>
