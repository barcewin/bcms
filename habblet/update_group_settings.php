<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$groupid = FilterText($_POST['groupId']);
if(!is_numeric($groupid)){ exit; }

$check = mysql_query("SELECT rank FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' AND rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$my_membership = mysql_fetch_assoc($check);
	$member_rank = $my_membership['rank'];
} else {

?>

No se han podido guardar los cambios.<p><a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>" class="new-button"><b>Volver</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";

<?php }

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$groupdata = mysql_fetch_assoc($check);
	$ownerid = $groupdata['ownerid'];
} else {

?>

No se han podido guardar los cambios.<p><a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>" class="new-button"><b>Volver</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";

<?php }

if($ownerid !== $my_id){ exit; }

$name = trim(FilterText($_POST['name']));
$description = trim(FilterText($_POST['description']));
$type = FilterText($_POST['type']);
$pane = FilterText($_POST['forumType']);
$topic = FilterText($_POST['newTopicPermission']);

if($groupdata['type'] == "3" && $_POST['type'] !== "3"){ echo "No puedes cambiar el tipo de grupo."; exit; } // you can't change the group type once you set it to 4, fool
if($type < 0 || $type > 3){ echo "Tipo de grupo inv&aacute;lido."; exit; } // this naughty user doesn't even deserve an settings update

if(strlen(HoloText($name)) > 25){ ?>
Nombre del grupo demasiado largo. (Max. 25)<p><a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>" class="new-button"><b>Volver</b><i></i></a></p><div class="clear"></div>
<?php } elseif(strlen(HoloText($description)) > 255){ ?>
Descripci&oacute;n del grupo demasiado laarga. (Max. 255)<p><a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>" class="new-button"><b>Volver</b><i></i></a></p><div class="clear"></div>
<?php } elseif(strlen(HoloText($name)) < 1){ ?>
Debe introducir un nombre para el grupo.<p><a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>" class="new-button"><b>Volver</b><i></i></a></p><div class="clear"></div>	
<?php } else { mysql_query("UPDATE group_details SET name = '".$name."', description = '".$description."', type = '".$type."',forum='".$pane."',topics='".$topic."',roomid='".FilterText($_POST['roomId'])."' WHERE id = '".$groupid."' AND ownerid = '".$my_id."' LIMIT 1") or die(mysql_error()); ?>
<?php echo FilterText($_POST['forum_type']); ?> Grupo guardado correctamente.<p><a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>" class="new-button"><b>Volver</b><i></i></a></p><div class="clear"></div>

<?php } ?>