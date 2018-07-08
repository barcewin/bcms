<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$groupid = FilterText($_POST['groupId']);

if(is_numeric($groupid) && $groupid > 0){

	$check = mysql_query("SELECT type FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());

	if(mysql_num_rows($check) > 0){

		$check2 = mysql_query("SELECT id_group FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' LIMIT 1") or die(mysql_errors());

		$memberships = mysql_evaluate("SELECT COUNT(*) FROM group_members WHERE id_user = '".$my_id."'");
		if($memberships > 99){
			echo "<p>\nYa est&aacute;s en otros 100 grupos.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
			exit;			
		}

		if(mysql_num_rows($check2) > 0){

			echo "<p>\nUsted ya es miembro de este grupo, puede que su solicitud a&uacute;n no haya sido procesada.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
			exit;

		} else {

			$groupdata = mysql_fetch_assoc($check);
			$type = $groupdata['type'];
			$members = mysql_evaluate("SELECT COUNT(*) FROM group_members WHERE id_group = '".$groupid."' AND is_pending = '0'");

			if($type == "0" || $type == "3"){
				if($type == "0" && $members < 1000 || $type == "3"){
					echo "<p>\nTe has unido al grupo.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
					mysql_query("INSERT INTO group_members (id_user,id_group,rank,is_current,is_pending) VALUES ('".$my_id."','".$groupid."','1','0','0')") or die(mysql_error());
					exit;
				} else {
					echo "<p>\nEl grupo ha alcanzado el l&iacute;mite de miembros.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
					exit;
				}
			} elseif($type == "1"){
				echo "<p>\nSe envi&oacute; una solicitud al grupo. El administrador la aceptara o rechazara.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
				mysql_query("INSERT INTO group_members (id_user,id_group,rank,is_current,is_pending) VALUES ('".$my_id."','".$groupid."','1','0','1')") or die(mysql_error());
				exit;
			} elseif($type == "2"){
				echo "<p>\nEl grupo esta cerrado.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
				exit;
			}

		}

	} else {

		echo "1";
		exit;

	}

}

?>