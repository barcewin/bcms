<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$entryid = FilterText($_POST['entryId']);
$widgetid = FilterText($_POST['widgetId']);

mysql_query("DELETE FROM homes_guestbook WHERE id = '".$entryid."' LIMIT 1");

?>