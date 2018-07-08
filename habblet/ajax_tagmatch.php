<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$name = FilterText($_POST['friendName']);
$sql = mysql_query("SELECT tag FROM user_tags WHERE user_id = '".$my_id."'") or die(mysql_error());
$i = 0;

while($row = mysql_fetch_row($sql)){
	$mytag[$i] = $row[0];
	$i++;
}

$sql = mysql_query("SELECT id FROM users WHERE username = '".$name."' LIMIT 1");
$sql_b = mysql_fetch_assoc($sql);
$sql_a = mysql_num_rows($sql);

if($sql_a == 0){
	echo'<div class="tag-match-error">Username nicht gefunden.</div>';
	exit;
}


$i = 0;
$sql = mysql_query("SELECT tag FROM user_tags WHERE user_id = '".$sql_b['id']."'") or die(mysql_error());
while($row = mysql_fetch_row($sql)){
$theirtag[$i] = $row[0];
$i++;
}
if(!is_array($mytag)){ $mytag = array(); }
if(!is_array($theirtag)){ $theirtag = array(); }
$identical = array_intersect($mytag, $theirtag);
$count['mine'] = count($mytag);
$count['same'] = count($theirtag);
if($count['mine'] == 0){ $count['mine'] = 1; }
$percent = ceil(($count['same'] / $count['mine']) * 100);

if($percent < 1){
	$text = "No se ha podido hacer.";
}elseif($percent > 75){
	$text = "Se llevan bien :)";
}else{
	$text = "Finalmente coinciden";
}

?>
    <div id="tag-match-value" style="display: none;"><?php echo $percent; ?></div>

    <div id="tag-match-value-display"><?php $percent; ?> %</div>

    <div id="tag-match-slogan" style="display: none;">
            <?php echo $text; ?>
    </div>