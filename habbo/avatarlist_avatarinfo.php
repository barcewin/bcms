<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$id = FilterText($_POST['anAccountId']);
$ownerid = FilterText($_POST['ownerAccountId']);

$usersql = mysql_query("SELECT * FROM users WHERE id = '".$id."' LIMIT 1");
$userdata = mysql_fetch_assoc($usersql);

$badgesql = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$id."' AND badge_slot = '1' LIMIT 1");

if(mysql_num_rows($badgesql) != 0){
	$badgerow = mysql_fetch_assoc($badgesql);
	$badge = $badgerow['badge_id'];
}else{
	$badge = "";
}

$groupmemberssql = mysql_query("SELECT * FROM group_members WHERE id_user = '".$id."' AND is_current = '1'");
$groupmembersrow = mysql_fetch_assoc($groupmemberssql);

if(mysql_num_rows($groupmemberssql) > 0){
$groupsql = mysql_query("SELECT * FROM group_details WHERE id = '".$groupmembersrow['id_group']."'");
$grouprow = mysql_fetch_assoc($groupsql);
}

if($userdata['online'] == '1'){
	$online = "habbo_online_anim_big.gif";
}else{
	$online = "habbo_offline_big.gif";
}

?>
<div class="avatar-list-info-container">
	<div class="avatar-info-basic clearfix">
		<div class="avatar-list-info-close-container"><a href="#" class="avatar-list-info-close" id="avatar-list-info-close-<?php echo $userdata['id']; ?>"></a></div>
		<div class="avatar-info-image">
		<?php if($badge != ""){ echo "<img src=\"".$cimagesurl.$badgesurl.$badge.".gif\">"; } ?>
		<?php if(mysql_num_rows($groupmemberssql) > 0){ ?><a href="<?php echo $path; ?>/groups/<?php echo $grouprow['id']; ?>"><img src="<?php echo $path; ?>/habbo-imaging/badge.php?badge=<?php echo $grouprow['badge']; ?>"></a><?php } ?>
		<img src="http://www.habbo.de/habbo-imaging/avatarimage?figure=<?php echo $userdata['look']; ?>&size=l&direction=4&head_direction=4" alt="<?php echo $userdata['username']; ?>" />
		</div>
<h4><a href="<?php echo $path; ?>/home/<?php echo $userdata['username']; ?>"><?php echo $userdata['username']; ?></a></h4>
<p>
<img src="./web-gallery/images/myhabbo/<?php echo $online; ?>" />
</p>
<p><?php echo $shortname; ?> gemaakt<br>op: <b><?php echo $userdata['birth']; ?></b></p>
<p><a href="<?php echo $path; ?>/home/<?php echo $userdata['username']; ?>" class="arrow"><?php echo $userdata['username']; ?>'s Home &raquo;</a></p>
<p class="avatar-info-motto"><?php echo $userdata['motto']; ?></p>
	</div>
</div>