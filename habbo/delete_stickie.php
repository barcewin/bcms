<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$check = mysql_query("SELECT groupid,active FROM homes_group_linker WHERE userid = '".$my_id."' AND active = '1' LIMIT 1") or die(mysql_error());
$linked = mysql_num_rows($check);

if($linked > 0){
	$linkdata = mysql_fetch_assoc($check);
	$groupid = $linkdata['groupid'];
}

$stickie = FilterText($_POST['stickieId']);

	if(is_numeric($stickie)){
		if($linked > 0){
			$sql = mysql_query("SELECT * FROM homes_stickers WHERE groupid = '".$groupid."' AND type = '3' AND id = '".$stickie."' LIMIT 1") or die(mysql_error());
		} else {
			$sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '3' AND id = '".$stickie."' LIMIT 1") or die(mysql_error());
		}
	} else {
		exit;
	}

	$num = mysql_num_rows($sql);

	if($num > 0){
		if($linked > 0){
			mysql_query("DELETE FROM homes_stickers WHERE groupid = '".$groupid."' AND type = '3' AND id = '".$stickie."' LIMIT 1");
		} else {
			mysql_query("DELETE FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '3' AND id = '".$stickie."' LIMIT 1");
		}
		echo "SUCCESS";
	} else {
		echo "ERROR";
	}

?>