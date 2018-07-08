<?php
require_once('./data_classes/server-data.php_data_classes-core.php.php');
require_once('./data_classes/server-data.php_data_classes-session.php.php');

if (!isset($_SESSION)) {
	session_start();
}
// anti flood protection
if($_SESSION['last_session_request'] > time() - 1800){ //última petición si ha sido hace 30 minutos
//redirección a una página para ver los pseudojuankers captando las ips
    header("location: /clientutils");
    exit;
}
$_SESSION['last_session_request'] = time();
mysql_query('UPDATE `users` SET `time` = time+1 WHERE `id`= "'.$my_id.'"') or die(mysql_error());
?>
<meta http-equiv="refresh" content="1805" />