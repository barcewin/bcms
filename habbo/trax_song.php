<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$id = FilterText($_GET['songId']);

$mysql = mysql_query("SELECT * FROM soundmachine_songs WHERE id = '".$id."' LIMIT 1");
$mysql = mysql_fetch_assoc($mysql);
$song = $mysql['data'];
$song = substr($song, 0, -1);
$song = str_replace(":4:", "&track4=", $song);
$song = str_replace(":3:", "&track3=", $song);
$song = str_replace(":2:", "&track2=", $song);
$song = str_replace("1:", "&track1=", $song);
$sql = mysql_query("SELECT * FROM users WHERE name = '".$mysql['owner']."' LIMIT 1");
$userrow = mysql_fetch_assoc($sql);
$output = "status=0&name=".trim(nl2br(HoloText($mysql['title'])))."&author=".$userrow['username'].$song;
echo $output;
?>