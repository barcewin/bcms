<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$groupid = FilterText($_POST['groupId']);
$badge = FilterText($_POST['code']);
$appkey = FilterText($_POST['__app_key']);

if(!is_numeric($groupid)){ exit; }
if($appkey !== "Rehotel.de"){ exit; }

$badge = str_replace("NaN", "", $badge);

$check = mysql_query("SELECT rank FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' AND rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
    $my_membership = mysql_fetch_assoc($check);
    $member_rank = $my_membership['rank'];
    if($member_rank < 2){ exit; }
} else {
    exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
$valid = mysql_num_rows($check);
$row = mysql_fetch_assoc($check);
if($valid > 0){ $groupdata = mysql_fetch_assoc($check); } else { exit; }
if($badge != $row[badge]) {
if($row[badge] != b0503Xs09114s05013s05015) {
$image = "".$path."/habbo-imaging/badge-fill/$row[badge].gif";
if(file_exists($image)) {
unlink($image);
}
} else {
mysql_query("UPDATE group_details SET badge = '".FilterText($badge)."' WHERE id = '".$groupid."' LIMIT 1");
header("Location: ".$path."/groups/".$groupid."&x=BadgeUpdated"); exit;
}
}
mysql_query("UPDATE group_details SET badge = '".FilterText($badge)."' WHERE id = '".$groupid."' LIMIT 1");
header("Location: ".$path."/groups/".$groupid."&x=BadgeUpdated"); exit;

?> 
