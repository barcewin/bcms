<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$refer = $_SERVER['HTTP_REFERER']; 
$pos = strrpos($refer, "groups"); 
if ($pos === false){
	exit;
}
$groupid = FilterText($_POST['groupId']);

$targets = FilterText($_POST['targetIds']);  
$targets = explode(",", $targets);

if(!is_numeric($groupid)){
	exit;
}

$check = mysql_query("SELECT * FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' AND rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());
if(mysql_num_rows($check) > 0){
	$my_membership = mysql_fetch_assoc($check);
	$member_rank = $my_membership['rank'];
	if($member_rank < 2){ 
		exit;
	}
} else {
	exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
if(mysql_num_rows($check) < 1){
	exit;
}

foreach($targets as $member){
        header("X-Whatever: \"Lo sentimos, ".$member."\"");
        if(is_numeric($member)){
                $valid = mysql_evaluate("SELECT COUNT(*) FROM users WHERE id = '".$member."' LIMIT 1");
                if($valid > 0){
                        mysql_query("DELETE FROM group_members WHERE id_user = '".$member."' AND id_group = '".$groupid."' LIMIT 1") or die(mysql_error());
                }
        }
}

echo "OK"; exit;

?>