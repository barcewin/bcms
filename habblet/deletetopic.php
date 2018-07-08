<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$topicid = FilterText($_POST['topicId']);

if(is_numeric($topicid)){
	if($user_rank > 5){
		$check = mysql_query("SELECT id FROM cms_forum_threads WHERE id = '".$topicid."' LIMIT 1");
		$exists = mysql_num_rows($check);
		if($exists > 0){
			mysql_query("DELETE FROM cms_forum_threads WHERE id = '".$topicid."' LIMIT 1");
			mysql_query("DELETE FROM cms_forum_posts WHERE threadid = '".$topicid."'");
			echo "SUCCESS";
			exit;
		} else {
			exit;
		}
	} else {
		exit;
	}
} else {
	exit;
}

?>