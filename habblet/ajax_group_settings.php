<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

// simple check to avoid most direct access

$groupid = FilterText($_POST['groupId']);
if(!is_numeric($groupid)){ exit; }

$check = mysql_query("SELECT rank FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' AND rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$my_membership = mysql_fetch_assoc($check);
	$member_rank = $my_membership['rank'];
} else {
	exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
$valid = mysql_num_rows($check);

if($valid > 0){
	$groupdata = mysql_fetch_assoc($check);
	$ownerid = $groupdata['ownerid'];
} else {
	exit;
}

if($ownerid !== $my_id){ exit; }
?>
<form action="#" method="post" id="group-settings-form">

<div id="group-settings">
<div id="group-settings-data" class="group-settings-pane">
    <div id="group-logo">
        <img src="./habbo-imaging/badge-fill/<?php echo $groupdata['badge']; ?>.gif" />
	</div>
	<div id="group-identity-area">
        <div id="group-name-area">
            <div id="group_name_message_error" class="error"></div>
            <label for="group_name" id="group_name_text">Nombre del grupo:</label>
            <input type="text" name="group_name" id="group_name" onKeyUp="GroupUtils.validateGroupElements('group_name', 25, 'El nombre del grupo debe tener 25 caracteres como m&aacute;ximo');" value="<?php echo HoloText($groupdata['name']); ?>"/><br />
        </div>

        <div id="group-url-area">
            <div id="group_url_message_error" class="error"></div>
                <label for="group_url" id="group_url_text"></label><br/>
                <?php /* <span id="group_url_text"><a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>ddsa">groups/<?php echo $groupid; ?></a></span><br/> */ ?>
                <input type="hidden" name="group_url" id="group_url" value="system"/>
                <input type="hidden" name="group_url_edited" id="group_url_edited" value="0"/>
        </div>
    </div>
    

	<div id="group-description-area">
	    <div id="group_description_message_error" class="error"></div>
	    <label for="group_description" id="description_text">Descripci&oacute;n:</label>
	    <span id="description_chars_left">
	        <label for="characters_left">Car&aacute;cteres:</label>
	        <input id="group_description-counter" type="text" value="<?php echo 255 - strlen(HoloText($groupdata['description'])); ?>" size="3" readonly="readonly" class="amount" />
	    </span>
	    <textarea name="group_description" id="group_description" onKeyUp="GroupUtils.validateGroupElements('group_description', 255, 'Description limit reached');"><?php echo HoloText($groupdata['description']); ?></textarea>
	</div>

</div>

<div id="group-settings-type" class="group-settings-pane group-settings-selection">
    <label for="group_type">Tipo de grupo:</label>
        <input type="radio" name="group_type" id="group_type" value="0" <?php if($groupdata['type'] == "0"){ echo "checked=\"checked\""; } elseif($groupdata['type'] == "3"){ echo "disabled=\"disabled\""; } ?> />
        <div class="description">
            <div class="group-type-normal">Normal</div>
            <p>Todo el mundo puede unirse. L&iacute;mite de personas: 500</p>
        </div>
        <input type="radio" name="group_type" id="group_type" value="1" <?php if($groupdata['type'] == "1"){ echo "checked=\"checked\""; } elseif($groupdata['type'] == "3"){ echo "disabled=\"disabled\""; } ?> />
        <div class="description">
            <div class="group-type-exclusive">Exclusivo</div>
            <p>Los administradores deciden qui&eacute;n se une.</p>
        </div>
        <input type="radio" name="group_type" id="group_type" value="2" <?php if($groupdata['type'] == "2"){ echo "checked=\"checked\""; } elseif($groupdata['type'] == "3"){ echo "disabled=\"disabled\""; } ?> />
        <div class="description">
            <div class="group-type-private">Privado</div>
            <p>Nadie puede unirse.</p>
        </div>
        <input type="radio" name="group_type" id="group_type" value="3" <?php if($groupdata['type'] == "3"){ echo "checked=\"checked\" disabled=\"disabled\""; } ?> />
        <div class="description">
            <div class="group-type-large">Ilimitado</div>
            <p>Todo el mundo puede participar. No hay l&iacute;mite de personas.</p>
                <p class="description-note">Nota: Esta opci&oacute;n no puede modificarse despu&eacute;s.</p>
        </div>

    <input type="hidden" id="initial_group_type" value="<?php echo $groupdata['type']; ?>">
</div>
</div>


<div id="forum-settings" style="display: none;">
<div id="forum-settings-type" class="group-settings-pane group-settings-selection">
    <label for="forum_type">Tipo de foro:</label>
        <input type="radio" name="forum_type" id="forum_type" value="0" <?php if($groupdata['forum'] == 0) { echo 'checked="checked"'; } ?> />
        <div class="description">
            P&uacute;blico<br />
            <p>Cualquiera puede leer las entradas.</p>
        </div>
        <input type="radio" name="forum_type" id="forum_type" value="1" <?php if($groupdata['forum'] == 1) { echo 'checked="checked"'; } ?> />
        <div class="description">
            Privado<br />
            <p>Solo los miembros pueden leer las entradas.</p>
        </div>
</div>

<div id="forum-settings-topics" class="group-settings-pane group-settings-selection">
    <label for="new_topic_permission">Temas:</label>
        <input type="radio" name="new_topic_permission" id="new_topic_permission" value="2" <?php if($groupdata['topics'] == 2) { echo 'checked="checked"'; } ?> />
        <div class="description">
            Administrador<br />
            <p>Solo los administradores pueden crear un nuevo tema.</p>
        </div>
        <input type="radio" name="new_topic_permission" id="new_topic_permission" value="1" <?php if($groupdata['topics'] == 1) { echo 'checked="checked"'; } ?> />
        <div class="description">
            Miembros<br />
            <p>Solo los miembros pueden crear temas</p>
        </div>
        <input type="radio" name="new_topic_permission" id="new_topic_permission" value="0" <?php if($groupdata['topics'] == 0) { echo 'checked="checked"'; } ?> />
        <div class="description">
            Todos<br />
            <p>Cualquiera puede crear un tema nuevo</p>
        </div>
</div>
</div>


<div id="room-settings" style="display: none;">
<?php 

$sql = mysql_query("SELECT * FROM rooms WHERE owner = '".$name."'");
$groupdetails = mysql_query("SELECT * FROM group_details WHERE id= '".$groupid."' LIMIT 1");
$group = mysql_fetch_assoc($groupdetails); 

?>
<label>Sala del grupo:</label>

<div id="room-settings-id" class="group-settings-pane-wide group-settings-selection">

<ul><li><input type="radio" name="roomId" value=" " <?php if($group['roomid'] == "0" OR $group['roomid'] == "" OR $group['roomid'] == " ") { echo "checked"; } ?> /><div>Sin sala</div></li>

<?php 

while($row = mysql_fetch_assoc($sql)) {

$i++;

if(IsEven($i)){
	$even = "even";
} else {
 	$even = "odd";
}

?>
    	<li class="<?php echo $even; ?>">
    		<input type="radio" name="roomId" value="<?php echo $row['id']; ?>" <?php if($group['roomid'] == $row['id']) { echo "checked"; } ?> /><a href="<?php echo $path; ?>/client.php?forwardId=2&roomId=<?php echo $row['id']; ?>" onclick="HabboClient.roomForward(this, '<?php echo $row['id']; ?>', 'private'); return false;" target="client" class="room-enter">Selecciona uno!</a><div>
				<?php echo HoloText($row['caption']); if($row['caption'] == ""){ ?>&nbsp;<?php } ?><br />
				<span class="room-description"><?php echo HoloText($row['description']); if($row['description'] == "") { ?>&nbsp;<?php } ?></span>
			</div>
    	</li>
<?php } ?>
    </ul>
</div>

</div>

<div id="group-button-area">
     <a href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>#" id="group-settings-update-button" class="new-button"
     		onclick="showGroupSettingsConfirmation('<?php echo $groupid; ?>');">
        <b>Guardar</b><i></i>
    </a>
    <a id="group-delete-button" href="<?php echo $path; ?>/groups/<?php echo $groupid; ?>#" class="new-button red-button" onclick="openGroupActionDialog('<?php echo $path; ?>/habblet/ajax_groups_confirm_delete_group.php', '<?php echo $path; ?>/habblet/ajax_groups_delete_group.php', null , '<?php echo $groupid; ?>', null);">
        <b>Eliminar grupo</b><i></i>
    </a>
    <a href="#" id="group-settings-close-button" class="new-button" onclick="closeGroupSettings(); return false;"><b>Cancelar</b><i></i></a>
</div>
</form>

<div class="clear"></div>

<script type="text/javascript" language="JavaScript">
    L10N.put("group.settings.title.text", "Editar configuraci&oacute;n del grupo");
    L10N.put("group.settings.group_type_change_warning.normal", "&iquest;Est&aacute;s seguro que deseas cambiar el tipo de grupo a <strong\>Normal</strong\>?");
    L10N.put("group.settings.group_type_change_warning.exclusive", "&iquest;Est&aacute;s seguro que deseas cambiar el tipo de grupo a <strong \>Exclusivo</strong\>?");
    L10N.put("group.settings.group_type_change_warning.closed", "&iquest;Est&aacute;s seguro que deseas cambiar el tipo de grupo a <strong\>Privado</strong\>?");
    L10N.put("group.settings.group_type_change_warning.large", "&iquest;Est&aacute;s seguro que deseas cambiar el tipo de grupo a <strong\>Ilimitado</strong\>? Nota: Esta opci&oacute;n no puede ser modificado posteriormente.");
    L10N.put("myhabbo.groups.confirmation_ok", "OK");
    L10N.put("myhabbo.groups.confirmation_cancel", "Cancelar");
    switchGroupSettingsTab(null, "group");
</script>