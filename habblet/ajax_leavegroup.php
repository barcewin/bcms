<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$groupid = FilterText($_POST['groupId']);

if(is_numeric($groupid) && $groupid > 0){

	$check = mysql_query("SELECT type FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());

	if(mysql_num_rows($check) > 0){

		$check2 = mysql_query("SELECT id_group FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' LIMIT 1") or die(mysql_errors());

		if(mysql_num_rows($check2) > 0){

			mysql_query("DELETE FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' LIMIT 1") or die(mysql_error());
			echo "<script type=\"text/javascript\">\nlocation.href = habboReqPath + \"groups/".$groupid."\";\n</script>";
			echo "<p>Has abandonado el grupo.</p>";
			echo "<p>Por favor espera, ser&aacute;s redireccionado.</p>";

		} else {

			exit;

		}

	} else {

		exit;

	}

}

?>