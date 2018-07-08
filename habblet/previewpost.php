<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$x = FilterText($_GET['x']);

$group_badge = mysql_query("SELECT * FROM group_members WHERE id_user = '".$my_id."' AND is_current = '1'") or die(mysql_error());
$group = mysql_fetch_assoc($group_badge);

$group_details = mysql_fetch_assoc($group_details = mysql_query("SELECT badge FROM group_details WHERE id = '".$group['id_group']."'")) or die(mysql_error());

$userbadge = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$my_id."' AND badge_slot = '1'") or die(mysql_error());
$user_badge = mysql_fetch_assoc($userbadge);

if(!session_is_registered(username)){
	exit;
}

if($x !== "topic" && $x !== "post"){
	exit;
}

if(empty($_POST['topicName'])){
	$_POST['topicName'] = "Vista Previa";
}

if($myrow['online'] == "1"){
	$on = "online_anim";
} else {
	$on = "offline";
}

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="group-postlist-list" id="group-postlist-list">
<tr class="post-list-index-preview">
<td class="post-list-row-container">
	<a href=\home/<?php echo $myrow['username']; ?> class=\"post-list-creator-link post-list-creator-info\"><?php echo $myrow['username']; ?></a>&nbsp;
                                      <img src='./web-gallery/images/myhabbo/habbo_<?php echo $on; ?>.gif'>
		<div class=\"post-list-posts post-list-creator-info\">Mensajes: <?php echo $myrow['postcount']; ?></div>
<div class="clearfix">
<div class="post-list-creator-avatar"><img src="http://www.habbo.de/habbo-imaging/avatarimage?figure=<?php echo $myrow['look']; ?>&size=b&direction=2&head_direction=2&gesture=sml" alt="<?php echo $userdata['username']; ?>" /></div>
<div class="post-list-group-badge">

<?php if(mysql_num_rows($group_badge) > 0){ ?>
<a href="<?php echo $path; ?>/groups/<?php echo $group['id_group']; ?>"><img src="<?php echo $path; ?>/habbo-imaging/badge.php?badge=<?php echo $group_details['badge']; ?>" /></a><?php } ?>

</div>
<div class="post-list-avatar-badge">

<?php if(mysql_num_rows($userbadge) > 0){ ?>
<img src="<?php echo $cimagesurl.$badgesurl.$user_badge['badge_id']; ?>.gif">		
<?php } ?>

</div>
        </div>
        <div class="post-list-motto post-list-creator-info"><?php echo $myrow['motto']; ?></div>
	</td>
	<td class="post-list-message" valign="top" colspan="2">
            <a href="#" id="edit-post-message" class="resume-edit-link">&laquo; Volver</a>
        <span class="post-list-message-header"><?php echo $_POST['topicName']; ?></span><br />
        <span class="post-list-message-time"><?php echo $date_full; ?></span>
        <div class="post-list-report-element">
        </div>
        <div class="post-list-content-element">
            <?php echo bbcode_format(trim(nl2br(HoloText($_POST['message'])))); ?>
        </div>
	<div>&nbsp;</div><div>&nbsp;</div>

        <div>

<?php if($x == "topic"){ ?>
	<a id="topic-form-cancel-preview" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar</b><i></i></a>
	<a id="topic-form-save-preview" class="new-button green-button save-icon" href="#"><b><span></span>Aceptar</b><i></i></a>
<?php } else { ?>
	<a id="post-form-cancel" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar</b><i></i></a>
	<a id="post-form-save" class="new-button green-button save-icon" href="#"><b><span></span>Aceptar</b><i></i></a>
<?php } ?>

</div>
</td>
</tr>
</table>