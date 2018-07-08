<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$ownerid = FilterText($_POST['ownerId']);
$widgetid = FilterText($_POST['widgetId']);
$message = FilterText($_POST['message']);
$sql = mysql_query("SELECT NOW()");
$date = mysql_result($sql, 0);

mysql_query("INSERT INTO homes_guestbook (message,time,widget_id,userid,pickup) VALUES ('".$message."','".$date_full."','".$widgetid."','".$my_id."','1')");

$row = mysql_fetch_assoc(mysql_query("SELECT * FROM homes_guestbook WHERE userid = '".$my_id."' ORDER BY id DESC LIMIT 1"));
$userrow = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$row['userid']."'"));

?>

<li id="guestbook-entry-<?php echo $row['id']; ?>" class="guestbook-entry">

<div class="guestbook-author">
<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $userrow['look']; ?>&direction=2&head_direction=2&gesture=sml&size=s" alt="<?php echo $userrow['username'] ?>" title="<?php echo $userrow['username'] ?>"/>
</div>

	<div class="guestbook-actions">
	<img src="../web-gallery/images/myhabbo/buttons/delete_entry_button.gif" id="gbentry-delete-<?php echo $row['id']; ?>" class="gbentry-delete" style="cursor:pointer" alt=""/><br/>
	</div>
		<div class="guestbook-message">
			<div class="<?php if($userrow['online'] == '1'){ ?>online<?php }else{ ?>offline<?php } ?>">
				<a href="../home/<?php echo $userrow['username']; ?>"><?php echo $userrow['username']; ?></a>
			</div>
			<p><?php echo HoloText($row["message"],false,true); ?></p>
		</div>
		<div class="guestbook-cleaner">&nbsp;</div>
		<div class="guestbook-entry-footer metadata"><?php echo $row['time']; ?></div>
	</li>