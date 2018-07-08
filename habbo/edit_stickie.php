<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$check = mysql_query("SELECT groupid,active FROM homes_group_linker WHERE userid = '".$my_id."' AND active = '1' LIMIT 1") or die(mysql_error());
$linked = mysql_num_rows($check);

if($linked > 0){
	$linkdata = mysql_fetch_assoc($check);
	$groupid = $linkdata['groupid'];
}

	// Collect variables
	$newskin = FilterText($_POST['skinId']);
	$stickie = FilterText($_POST['stickieId']);

	if($newskin == 1){ $skin = "defaultskin"; }
	else if($newskin == 2){ $skin = "speechbubbleskin"; }
	else if($newskin == 3){ $skin = "metalskin"; }
	else if($newskin == 4){ $skin = "noteitskin"; }
	else if($newskin == 5){ $skin = "notepadskin"; }
	else if($newskin == 6){ $skin = "goldenskin"; }
	else if($newskin == 7){ $skin = "hc_machineskin"; }
	else if($newskin == 8){ $skin = "hc_pillowskin"; }
	else if($newskin == 9 && $user_rank > 5){ $skin = "nakedskin"; }
	else { $skin = "defaultskin"; }

	if(is_numeric($stickie)){
		if($linked > 0){
			$sql = mysql_query("SELECT * FROM homes_stickers WHERE groupid = '".$groupid."' AND id = '".$stickie."' LIMIT 1") or die(mysql_error());
		} else {
			$sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND id = '".$stickie."' LIMIT 1") or die(mysql_error());
		}
	} else {
		exit;
	}

	$num = mysql_num_rows($sql);

	if($num > 0){
		$dat = mysql_fetch_assoc($sql);
		if($linked > 0){
			mysql_query("UPDATE homes_stickers SET skin = '".$skin."' WHERE groupid = '".$groupid."' AND type = '3' AND id = '".$stickie."' LIMIT 1");
		} else {
			mysql_query("UPDATE homes_stickers SET skin = '".$skin."' WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '3' AND id = '".$stickie."' LIMIT 1");			
		}
		header("X-JSON: {\"cssClass\":\"n_skin_" . $skin . "\",\"type\":\"stickie\",\"id\":\"" . $stickie . "\"}");
		echo "SUCCESS";
	} else {
		echo "ERROR";
	}

?>