<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$refer = $_SERVER['HTTP_REFERER'];
$pos = strrpos($refer, "groups");
if($pos === false){
	exit;
}

$groupid = FilterText($_POST['groupId']);

if(!is_numeric($groupid)){
	exit;
}

$check = mysql_query("SELECT * FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' AND rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$my_membership = mysql_fetch_assoc($check);
	$member_rank = $my_membership['rank'];
} else {
	exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$groupdata = mysql_fetch_assoc($check);
	$ownerid = $groupdata['ownerid'];
} else {
	exit;
}

if($ownerid !== $my_id){
	exit;
} elseif($ownerid == $my_id){
	error_reporting(0);
	$image = "".$path."/habbo-imaging/badge-fill/$groupdata[badge].gif";

	if(file_exists($image)) {
		unlink($image);
	}
	error_reporting(1);
	mysql_query("DELETE FROM group_details WHERE id = '".$groupid."' LIMIT 1");
	mysql_query("DELETE FROM group_members WHERE id_group = '".$groupid."'");
	mysql_query("DELETE FROM homes_group_linker WHERE groupid = '".$groupid."'");
	mysql_query("DELETE FROM homes_stickers WHERE groupid = '".$groupid."'");
	echo "<p>\nEl grupo ha sido eliminado correctamente.\n</p>\n\n<p>\n<a href=\"".$path."\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
}

?>