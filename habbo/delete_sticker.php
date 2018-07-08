<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$check = mysql_query("SELECT groupid,active FROM homes_group_linker WHERE userid = '".$my_id."' AND active = '1' LIMIT 1") or die(mysql_error());
$linked = mysql_num_rows($check);

if($linked > 0){
	$linkdata = mysql_fetch_assoc($check);
	$groupid = $linkdata['groupid'];
}

$sticker = FilterText($_POST['stickerId']);

	if(is_numeric($sticker)){
		if($linked > 0){
			$sql = mysql_query("SELECT * FROM homes_stickers WHERE groupid = '".$groupid."' AND type = '1' AND id = '".$sticker."' LIMIT 1") or die(mysql_error());
		} else {
			$sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '1' AND id = '".$sticker."' LIMIT 1") or die(mysql_error());
		}
	} else {
		exit;
	}

	$num = mysql_num_rows($sql);

	if($num > 0){
		if($linked > 0){
			mysql_query("DELETE FROM homes_stickers WHERE groupid = '".$groupid."' AND type = '1' AND id = '".$sticker."' LIMIT 1") or die(mysql_error());
		} else {
			mysql_query("DELETE FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '1' AND id = '".$sticker."' LIMIT 1") or die(mysql_error());
		}
	$dat = mysql_fetch_assoc($sql);
	$check = mysql_query("SELECT id FROM homes_inventory WHERE type = '1' AND data = '".$dat['data']."' AND userid = '".$my_id."' LIMIT 1") or die(mysql_error());
	$exists = mysql_num_rows($check);
		if($exists > 0){
		mysql_query("UPDATE homes_inventory SET amount = amount + 1 WHERE userid = '".$my_id."' AND data = '".$dat['data']."' AND type = '1' LIMIT 1") or die(mysql_error());
		} else {
		mysql_query("INSERT INTO homes_inventory (userid,type,subtype,data,amount) VALUES ('".$my_id."','1','1','".$dat['data']."','1')") or die(mysql_error());
		}
	echo "SUCCESS";
	} else {
	echo "ERROR";
	}

?>