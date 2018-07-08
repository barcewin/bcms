<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$refer = $_SERVER['HTTP_REFERER']; 
$pos = strrpos($refer, "groups"); 
if($pos === false){
	exit;
}

$groupid = FilterText($_POST['groupId']);
$targets = FilterText($_POST['targetIds']);

$targets = explode(",", $targets);
if(!is_numeric($groupid)){
	exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
if(mysql_num_rows($check) < 1){
	exit;
}

foreach($targets as $member){
        if(is_numeric($member)){
                $valid = mysql_evaluate("SELECT COUNT(*) FROM users WHERE id = '".$member."' LIMIT 1");
                if(mysql_num_rows($check) > 0){
                        mysql_query("UPDATE group_members SET is_pending = '0' WHERE id_user = '".$member."' AND id_group = '".$groupid."' LIMIT 1") or die(mysql_error());
                }
        }
}

echo "OK"; exit;

?>