<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$refer = $_SERVER['HTTP_REFERER'];
$pos = strrpos($refer, "groups");

if($pos === false){ 
	exit;
}

$groupid = $_POST['groupId'];

if(!is_numeric($groupid)){ 
	exit; 
}

$check = mysql_query("SELECT rank FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' AND rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){

    $my_membership = mysql_fetch_assoc($check);
    $rank = $my_membership['rank'];
    if($rank < 2){ exit; }

} else {
    exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
$valid = mysql_num_rows($check);

if($valid > 0){ $groupdata = mysql_fetch_assoc($check); } else {exit; }

?>

<div id="badge-editor-flash" align="center">
<strong>Cargando Estilos de Placas...</strong>
</div>
<script type="text/javascript" language="JavaScript">
var swfobj = new SWFObject("flash/BadgeEditor.swf", "badgeEditor", "280", "366", "8");
swfobj.addParam("base", "flash/");
swfobj.addParam("bgcolor", "#FFFFFF");
swfobj.addVariable("post_url", "/save_group_badge.php");
swfobj.addVariable("__app_key", "Meth0d.org");
swfobj.addVariable("groupId", "<?php echo $groupid; ?>");
swfobj.addVariable("badge_data", "<?php echo $groupdata['badge']; ?>");
swfobj.addVariable("localization_url", "badge_editor.xml");
swfobj.addVariable("xml_url", "badge_data.xml");
swfobj.addParam("allowScriptAccess", "always");
swfobj.write("badge-editor-flash");
</script>