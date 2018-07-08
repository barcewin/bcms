<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$feedItemIndex = FilterText($_POST['feedItemIndex']);
if(!is_numeric($feedItemIndex)){ exit; }

mysql_query("DELETE FROM cms_alerts WHERE userid = '".$my_id."' LIMIT 1");
?>