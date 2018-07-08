<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

if(isset($_GET['web-home-name'])){
	$searchname = FilterText($_GET['web-home-name']);
} else if(isset($_POST['name'])){
	$searchname = FilterText($_POST['web-home-name']);
} else {
	$error = true;
}

$note = explode("/", $_POST['stickienotes']);
$widget = explode("/", $_POST['widgets']);
$sticker = explode("/", $_POST['stickers']);
$background = explode(":", $_POST['background']);

$check = mysql_query("SELECT * FROM homes_group_linker WHERE userid = '".$my_id."' AND active = '1' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$linkdata = mysql_fetch_assoc($check);
	$groupid = $linkdata['groupid'];
}

if(!empty($background[1])){
	$bg = str_replace("b_","",$background[1]);
	echo $bg;
	$check = mysql_query("SELECT id FROM homes_inventory WHERE userid = '".$my_id."' AND type = '4' AND data = '" . FilterText($bg) . "' LIMIT 1") or die(mysql_error());
	$valid = mysql_num_rows($check);
	if($valid > 0){
		if(!isset($groupid)){
			$check = mysql_query("SELECT data FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '4' LIMIT 1") or die(mysql_error());
		} else {
			$check = mysql_query("SELECT data FROM homes_stickers WHERE groupid = '".$groupid."' AND type = '4' LIMIT 1") or die(mysql_error());
		}
		$exists = mysql_num_rows($check);
		if($exists > 0){
			if(!isset($groupid)){
				mysql_query("UPDATE homes_stickers SET data = '" . $bg . "' WHERE type = '4' AND userid = '".$my_id."' AND groupid = '-1' LIMIT 1") or die(mysql_error());
			} else {
				mysql_query("UPDATE homes_stickers SET data = '" . $bg . "' WHERE type = '4' AND groupid = '".$groupid."' LIMIT 1") or die(mysql_error());
			}
		} else {
			if(!isset($groupid)){
				mysql_query("INSERT INTO homes_stickers (userid,groupid,x,y,z,data,type,subtype,skin) VALUES ('" . $my_id . "','-1','-1','-1','-1','" . $bg . "','4','0','-1')") or die(mysql_error());
			} else {
				mysql_query("INSERT INTO homes_stickers (userid,groupid,x,y,z,data,type,subtype,skin) VALUES ('" . $my_id . "','".$groupid."','-1','-1','-1','" . $bg . "','4','0','-1')") or die(mysql_error());
			}
		}
	}
}

// Loop through each array of data we encountered and save the stuff that was passed onto us
foreach($widget as $raw){
	$bits = explode(":", $raw);
	$id = $bits[0];
	$data = FilterText($bits[1]);
	if(!empty($data) && !empty($id) && is_numeric($id)){
		$coordinates = explode(",", $data);
		$x = $coordinates[0];
		$y = $coordinates[1];
		$z = $coordinates[2];
		if(is_numeric($x) && is_numeric($y) && is_numeric($z)){
			if(isset($groupid)){
				mysql_query("UPDATE homes_stickers SET x = '".$x."', y = '".$y."', z = '".$z."' WHERE id = '".$id."' AND type = '2' AND groupid = '".$groupid."' LIMIT 1"); // or die(mysql_error());
			} else {
				mysql_query("UPDATE homes_stickers SET x = '".$x."', y = '".$y."', z = '".$z."' WHERE id = '".$id."' AND type = '2' AND userid = '".$my_id."' AND groupid = '-1' LIMIT 1"); // or die(mysql_error());
			}
		}
	}
}

foreach($sticker as $raw){
	$bits = explode(":", $raw);
	$id = $bits[0];
	$data = FilterText($bits[1]);
	if(!empty($data) && !empty($id) && is_numeric($id)){
		$coordinates = explode(",", $data);
		$x = $coordinates[0];
		$y = $coordinates[1];
		$z = $coordinates[2];
		if(is_numeric($x) && is_numeric($y) && is_numeric($z)){
			if(isset($groupid)){
				mysql_query("UPDATE homes_stickers SET x = '".$x."', y = '".$y."', z = '".$z."' WHERE id = '".$id."' AND type = '1' AND groupid = '".$groupid."' LIMIT 1"); // or die(mysql_error());
			} else {
				mysql_query("UPDATE homes_stickers SET x = '".$x."', y = '".$y."', z = '".$z."' WHERE id = '".$id."' AND type = '1' AND userid = '".$my_id."' AND groupid = '-1' LIMIT 1"); // or die(mysql_error());
			}
		}
	}
}

foreach($note as $raw){
	$bits = explode(":", $raw);
	$id = $bits[0];
	$data = FilterText($bits[1]);
	if(!empty($data) && !empty($id) && is_numeric($id)){
		$coordinates = explode(",", $data);
		$x = $coordinates[0];
		$y = $coordinates[1];
		$z = $coordinates[2];
		if(is_numeric($x) && is_numeric($y) && is_numeric($z)){
			if(isset($groupid)){
				mysql_query("UPDATE homes_stickers SET x = '".$x."', y = '".$y."', z = '".$z."' WHERE id = '".$id."' AND type = '3' AND groupid = '".$groupid."' LIMIT 1"); // or die(mysql_error());
			} else {
				mysql_query("UPDATE homes_stickers SET x = '".$x."', y = '".$y."', z = '".$z."' WHERE id = '".$id."' AND type = '3' AND userid = '".$my_id."' AND groupid = '-1' LIMIT 1"); // or die(mysql_error());
			}
		}
	}
}

if(isset($groupid)){
	mysql_query("DELETE FROM homes_group_linker WHERE userid = '".$my_id."'");
	echo "\n<script language=\"JavaScript\" type=\"text/javascript\">\nwaitAndGo('".$path."/groups/" . $groupid . "');\n</script>";
	exit;
} else {
	echo "\n<script language=\"JavaScript\" type=\"text/javascript\">\nwaitAndGo('".$path."/home/" . HoloText($name) . "');\n</script>";
	exit;
} ?>
