<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$groupid = FilterText($_POST['groupId']);

if(!empty($groupid) && is_numeric($groupid)){
    $check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
    $exists = mysql_num_rows($check);
} else {
    echo "<div class=\"groups-info-basic\">
	<div class=\"groups-info-close-container\"><a href=\"#\" class=\"groups-info-close\"></a></div>
        -/-
          </div>";
    exit;
}

if($exists < 1){ exit; }

$data = mysql_fetch_assoc($check);

echo "<div class=\"groups-info-basic\">
	<div class=\"groups-info-close-container\"><a href=\"#\" class=\"groups-info-close\"></a></div>
	
	<div class=\"groups-info-icon\"><a href=\"".$path."/groups/".$groupid."\"><img src=\"./habbo-imaging/badge-fill/".$data['badge'].".gif\" /></a></div>
	<h4><a href=\"".$path."/groups/".$groupid."\">".HoloText($data['name'])."</a></h4>
	
	<p>
Creado el:<br />
<b>".$data['created']."</b>
	</p>
	
	<div class=\"groups-info-description\">".HoloText(nl2br($data['description']))."</div>

</div>";