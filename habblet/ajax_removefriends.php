<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$pagesize = FilterText($_POST['pageSize']);

if(isset($_POST['friendList'])){
	$friends = FilterText($_POST['friendList']);
    foreach($friends as $val)
    {
        $sql = mysql_query("DELETE FROM messenger_friendships WHERE user_one_id = '".$my_id."' AND user_two_id = '".$val."'");
        $sql = mysql_query("DELETE FROM messenger_friendships WHERE user_two_id = '".$my_id."' AND user_one_id = '".$val."'");
    }
} elseif(isset($_POST['friendId'])){
	$friendid = FilterText($_POST['friendId']);
	$sql = mysql_query("DELETE FROM messenger_friendships WHERE user_one_id = '".$my_id."' AND user_two_id = '".$friendid."'");
	$sql = mysql_query("DELETE FROM messenger_friendships WHERE user_two_id = '".$my_id."' AND user_one_id = '".$friendid."'");
} else{
	echo "&iexcl;Error Desconocido!";
}

header("location:ajax_friendmanagement.php?pageNumber=1&pageSize=".$pagesize); exit;
?>