<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

if(isset($_POST['motto'])) {
		$motto = mysql_real_escape_string(htmlspecialchars(str_replace(chr(1)," ", str_replace(chr(2), " ", FilterText($_POST['motto'])))));
		mysql_query("UPDATE users SET motto = '".$motto."' WHERE id = '".$my_id."' LIMIT 1") or die(mysql_error());
		echo FilterText($_POST['motto']);
} else {
	echo $myrow['motto'];
} ?>