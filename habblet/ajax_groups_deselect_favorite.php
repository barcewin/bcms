<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$groupid = FilterText($_POST['groupId']);

if(is_numeric($groupid) && $groupid > 0){

	$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($check) > 0){

		$check2 = mysql_query("SELECT * FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' LIMIT 1");
		if(mysql_num_rows($check2) > 0){

			mysql_query("UPDATE group_members SET is_current = '0' WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' LIMIT 1");

		} else { 
			exit;
		}

	} else {
		exit;
	}
} ?>