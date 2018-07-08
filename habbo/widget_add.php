<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$widgetid = FilterText($_POST['widgetId']);
$zindex = FilterText($_POST['zindex']);

$check = mysql_query("SELECT groupid,active FROM homes_group_linker WHERE userid = '".$my_id."' AND active = '1' LIMIT 1") or die(mysql_error());
$linked = mysql_num_rows($check);
if($linked > 0){
    $link_info = mysql_fetch_assoc($check);
    $groupid = $link_info['groupid'];
    if(!is_numeric($groupid)){ exit; }
    $check = mysql_query("SELECT ownerid FROM group_details WHERE id = '".$groupid."' LIMIT 1");
    $exists = mysql_num_rows($check);
        if($exists < 1){
            $linked = 0;
            $groupid = -1;
        } else {
            $tmp = mysql_fetch_assoc($check);
            $ownerid = $tmp['ownerid'];
            $linked = 1;
        }
}

$widgetid = FilterText($_POST['widgetId']);
$zindex = FilterText($_POST['zindex']);
if(!is_numeric($zindex)){ exit; }
$privileged = FilterText($_POST['privileged']);

if(!empty($widgetid)){
    if($widgetid == "1"){ exit; } // User Profile / Group Profile; system default; can't be placed
    elseif($widgetid == "2" && $linked < 1){ $widget = "2"; } // User - Gruppen
    elseif($widgetid == "3" && $linked > 0){ $widget = "3"; } // Gruppen - Mitglieder
    elseif($widgetid == "3" && $linked < 1){ $widget = "3"; } // User - Räume
    elseif($widgetid == "4" && $linked < 1){ $widget = "4"; } // User - Gästebuch
    elseif($widgetid == "4" && $linked > 0){ $widget = "4"; } // Gruppen - Gästebuch
    elseif($widgetid == "5" && $linked < 1){ $widget = "5"; } // User - Freundesliste
    elseif($widgetid == "5" && $linked > 0){ $widget = "5"; } // Gruppen - Freundesliste
    elseif($widgetid == "6" && $linked < 1){ $widget = "6"; } // User - Trax
    elseif($widgetid == "7" && $linked < 1){ $widget = "7"; } // User - Highscore
    elseif($widgetid == "8" && $linked < 1){ $widget = "8"; } // User - Badges
    elseif($widgetid == "9" && $linked < 1){ $widget = "9"; } // User - Rating
    else { exit; }

?>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php if($widget == "2" && $linked < 1){ ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
        mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','-1','2','2','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $row = mysql_fetch_assoc($ret_sql);

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";
?>

<?php $groups = mysql_evaluate("SELECT COUNT(*) FROM group_members WHERE id_user = '".$my_id."' LIMIT 1"); ?>

<div class="movable widget GroupsWidget" id="widget-<?php echo $row['id']; ?>" style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $row['z']; ?>">
<div class="w_skin_<?php echo $row['skin']; ?>">
	<div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
		<div class="widget-headline"><h3><span class="header-left">&nbsp;</span><span class="header-middle">Meine Gruppen (<span id="groups-list-size"><?php echo $groups; ?></span>)</span><span class="header-right"><?php echo $edit; ?></span></h3>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-content">

<div class="groups-list-container">
<ul class="groups-list">

<?php

$get_groups = mysql_query("SELECT * FROM group_members WHERE id_user = '".$my_id."'") or die(mysql_error());

if(mysql_num_rows($get_groups) > 0){
while($members_row = mysql_fetch_assoc($get_groups)){

$get_groupdata = mysql_query("SELECT * FROM group_details WHERE id = '".$members_row['id_group']."' LIMIT 1") or die(mysql_error());
$grouprow = mysql_fetch_assoc($get_groupdata);

?>

	<li title="<?php echo $grouprow['name']; ?>" id="groups-list-<?php echo $row['id']; ?>-<?php echo $grouprow['id']; ?>">
	<div class="groups-list-icon"><a href="<?php echo $path; ?>/groups/<?php echo $$grouprow['id']; ?>"><img src='./habbo-imaging/badge-fill/<?php echo $grouprow['badge']; ?>.gif'></a></div>
	<div class="groups-list-open"></div>
	<h4><a href="<?php echo $path; ?>/groups/<?php echo $grouprow['id']; ?>"><?php echo $grouprow['name']; ?></a></h4>
	<p>
	Gesticht:<br />
	<?php if($members_row['is_current'] == 1){ ?><div class="favourite-group" title="Favourite"></div><?php } ?>
	<?php if($members_row['rank'] > 1 && $grouprow['ownerid'] !== $my_id){ ?><div class="admin-group" title="Admin"></div><?php } ?>
	<?php if($grouprow['ownerid'] == $my_id && $members_row['rank'] > 1){ ?><div class="owned-group" title="Besitzer"></div><?php } ?>
	<b><?php echo $grouprow['created']; ?></b>
	</p>
	<div class=\"clear\"></div>
	</li>

<?php } }else { echo"Zurzeit ist der User in keine Gruppe"; } ?>

</ul></div>

<div class="groups-list-loading"><div><a href="#" class="groups-loading-close"></a></div><div class="clear"></div><p style="text-align:center"><img src="./web-gallery/images/progress_bubbles.gif" alt="" width="29" height="6"></p></div>
<div class="groups-list-info"></div>

		<div class="clear"></div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
document.observe("dom:loaded", function() {
	new GroupsWidget('<?php echo $my_id; ?>', '<?php echo $my_id; ?>');
});
</script>

<?php } elseif($widget == "3" && $linked > 0){

        mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','".$groupid."','2','3','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '".$groupid."' AND type = '2' AND subtype = '3' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $ret_row = mysql_fetch_assoc($ret_sql);
        $saved_id = $ret_row['id'];

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";

        $members = mysql_evaluate("SELECT COUNT(*) FROM group_members WHERE id_group = '".$groupid."' AND is_pending = '0'");

?>

<div class="movable widget MemberWidget" id="widget-<?php echo $row['id']; ?>" style=" left: 20px; top: 20px; z-index: <?php echo $zindex; ?>;">
<div class="w_skin_defaultskin">
	<div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
		<div class="widget-headline"><h3><span class="header-left">&nbsp;</span><span class="header-middle">Mitglieder dieser Gruppe (<span id="avatar-list-size"><?php echo $members; ?></span>)</span><span class="header-right"><?php echo $edit; ?></span></h3>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-content">

<div id="avatar-list-search">
<input type="text" style="float:left;" id="avatarlist-search-string"/>
<a class="new-button" style="float:left;" id="avatarlist-search-button"><b>Suchen</b><i></i></a>
</div>
<br clear="all"/>

<div id="avatarlist-content">

<?php

$bypass = true;
$widgetid = $row['id'];
include('../myhabbo/avatarlist_membersearchpaging.php');

?>

echo "<script type="text/javascript">
document.observe("dom:loaded", function() {
	window.widget<?php echo $row['id']; ?> = new MemberWidget('<?php echo $groupid; ?>', '<?php echo $row['id']; ?>');
});
</script>

</div>
		<div class="clear"></div>
		</div>
	</div>
</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php } elseif($widget == "3" && $linked < 1){  ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
	mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','-1','2','3','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $row = mysql_fetch_assoc($ret_sql);

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";
?>

<div class="movable widget RoomsWidget" id="widget-<?php echo $row['id']; ?>" style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $row['z']; ?>;">
<div class="w_skin_<?php echo $row['skin']; ?>">
<div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">

<div class="widget-headline"><h3>
<?php echo $edit; ?>
</script>

<span class="header-left">&nbsp;</span><span class="header-middle">Meine R&auml;ume</span><span class="header-right">&nbsp;</span></h3>

</div>	
</div>

<div class="widget-body">
<div class="widget-content">

<?php 			

$roomsql = mysql_query("SELECT * FROM rooms WHERE owner = '".$my_id."'");
if(mysql_num_rows($roomsql) <> 0){ 

?>

<div id="room_wrapper">
<table border="0" cellpadding="0" cellspacing="0">

<?php 

$i = 0;
while ($room = mysql_fetch_assoc($roomsql)) {
$i++;

if(mysql_num_rows($roomsql) == $i){
	$asdf = " ";
} else {
	$asdf = "\"class=\"dotted-line\"";
}

if($room['state'] == "open"){
	$icon = "open";
	$text = "Raum betreten";
}elseif($room['state'] == "password"){
	$icon = "password";
	$text = "Passwort gesch&uuml;tzt";
} elseif($room['state'] == "locked"){
	$icon = "locked";
	$text = "Geschlossen";
}

?>

<tr>

<td valign="top">
<div class="room_image">
<img src="<?php echo $path; ?>/web-gallery/images/myhabbo/rooms/room_icon_<?php echo $icon; ?>.gif" alt="" align="middle"/>
</div>
</td>

<td <?php echo $asdf; ?>>
<div class="room_info">
<div class="room_name"><?php echo $room['caption']; ?></div>
<img id="room-<?php echo $room['id']; ?>-report" class="report-button report-r"alt="report" src="<?php echo $path; ?>/web-gallery/images/myhabbo/buttons/report_button.gif" style="display: none;" />

<div class="clear"></div>
<div><?php echo $room['description']; ?></div>

<a href="/client?forwardId=2&amp;roomId=<?php echo $room['id']; ?>" target="" id="room-navigation-link_<?php echo $room['id']; ?>" onclick="HabboClient.roomForward(this, '<?php echo $room['id']; ?>', 'private', true); return false;">
<?php echo $text; ?>
</a>
 
</div>
<br class="clear" />

</td>
</tr>

<?php } ?>

<br class="clear" />
</td>
</tr>
</table>
</div> 

<?php } else { echo "Dieser User hat noch keine R&auml;ume!"; } ?>

<div class="clear"></div>
</div>
</div>
</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php } elseif($widget == "4" && $linked < 1){ ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
	mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','-1','2','4','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $row = mysql_fetch_assoc($ret_sql);

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";

?>

<div class="movable widget GuestbookWidget" id="widget-<?php echo $row['id']; ?>" style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $row['z']; ?>;">
<div class="w_skin_<?php echo $row['skin']; ?>">
	<div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
		<div class="widget-headline"><h3>
		<?php echo $edit; ?>
		<span class="header-left">&nbsp;</span><span class="header-middle">G&auml;stebuch(<span id="guestbook-size">0</span>) <span id="guestbook-type" class="<?php echo $status; ?>"><?php if($row['10'] == "0"){ ?><img src="./web-gallery/images/groups/status_exclusive.gif" title="Nur Freunde" alt="Nur Freunde"/><?php } ?></span></span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div>

<div class="widget-body">
		<div class="widget-content">
<div id="guestbook-wrapper" class="gb-public">
<ul class="guestbook-entries" id="guestbook-entry-container">
	<div id="guestbook-empty-notes">Dieses G&auml;stebuch hat noch keine Eintr&auml;ge.</div>
</ul></div>
<script type="text/javascript">	
	document.observe("dom:loaded", function() {
		var gb81481 = new GuestbookWidget('17570', '<?php echo $row['id']; ?>', 500);
		var editMenuSection = $('guestbook-privacy-options');
		if (editMenuSection) {
			gb81481.updateOptionsList('public');
		}
	});
</script>
		<div class="clear"></div>
		</div>
	</div>
</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php } elseif($widget == "5" && $linked < 1){ ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
	mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z,var) VALUES ('".$my_id."','-1','2','5','defaultskin','20','20','".$zindex."','0')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT id FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $row = mysql_fetch_assoc($ret_sql);

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";

	$sql1 = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$my_id."'");
	$count = mysql_num_rows($sql1);
?>
	<div class="movable widget FriendsWidget" id="widget-<?php echo $row['id']; ?>" style=" left: 20px; top: 20px; z-index: <?php echo $zindex; ?>">
	<div class="w_skin_defaultskin">
	<div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
		<div class="widget-headline"><h3><span class="header-left">&nbsp;</span><span class="header-middle">Meine Freunde (<span id="avatar-list-size"><?php echo $count; ?></span>)</span><span class="header-right"><?php echo $edit; ?></span></h3>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-content">

<div id="avatar-list-search">
<input type="text" style="float:left;" id="avatarlist-search-string"/>
<a class="new-button" style="float:left;" id="avatarlist-search-button"><b>Suchen</b><i></i></a>
</div>
<br clear="all"/>

<div id="avatarlist-content">

<?php
$bypass = true;
$widgetid = $row['id'];
include('../myhabbo/avatarlist_friendsearchpaging.php');
?>

<script type="text/javascript">
document.observe("dom:loaded", function() {
	window.widget<?php echo $row['id']; ?> = new FriendsWidget('<?php echo $my_id; ?>', '<?php echo $row['id']; ?>');
});
</script>

</div>
		<div class="clear"></div>
		</div>
	</div>
</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php } elseif($widget == "6" && $linked < 1){  ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
	mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','-1','2','6','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT id FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $row = mysql_fetch_assoc($ret_sql);

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";

?>
			<div class="movable widget TraxPlayerWidget" id="widget-<?php echo $row['id']; ?>" style=" left: 20px; top: 20px; z-index: <?php echo $zindex; ?>;">
<div class="w_skin_defaultskin">
	<div class="widget-corner" id="widget-<?php echo $saved_id ?>-handle">
		<div class="widget-headline"><h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">Traxplayer</span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div>
	<div class="widget-body">
		<div class="widget-content">
<?php 
$sql1 = mysql_query("SELECT * FROM soundmachine_songs WHERE current = '1' AND owner = '".$my_id."' LIMIT 1");
@$songrow1 = mysql_fetch_assoc($sql); ?>
<div id="traxplayer-content" style="text-align: center;">
	<img src="./web-gallery/images/traxplayer/player.png"/>
</div>

<div id="edit-menu-trax-select-temp" style="display:none">
    <select id="trax-select-options-temp">
    <option value="">- Choose song -</option>
	<?php
	$mysql = mysql_query("SELECT * FROM furniture WHERE ownerid = '".$my_id."'");
	$i = 0;
	while($machinerow = mysql_fetch_assoc($mysql)){
		$i++;
		$sql = mysql_query("SELECT * FROM soundmachine_songs WHERE machineid = '".$machinerow['id']."'");
		$n = 0;
		while($songrow = mysql_fetch_assoc($sql)){
			$n++;
			if($songrow['id'] <> ""){ echo "		<option value=\"".$songrow['id']."\">".trim(nl2br(HoloText($songrow['title'])))."</option>\n"; }
		}
	} ?>
    </select>
</div>
		<div class="clear"></div>
		</div>
	</div>
</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php } elseif($widget == "7" && $linked < 1){  ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
	mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','-1','2','7','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT id FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $row = mysql_fetch_assoc($ret_sql);

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";

?>

<div class="movable widget HighScoresWidget" id="widget-<?php echo $row['id']; ?>" style=" left: 20px; top: 20px; z-index: <?php echo $zindex; ?>;">
<div class="w_skin_defaultskin">
	<div class="widget-corner" id="widget-<?php echo $saved_id ?>-handle">
		<div class="widget-headline"><h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">HIGH SCORE</span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div>
<div class="widget-body">
<div class="widget-content">

<table>
	<tr colspan="2">
		<th>Battle Ball</a></th>
	</tr>
	<tr>
		<td>Gespielt</td>
		<td>-/-</td>
	</tr>

	<tr>
		<td>Punkte</td>
		<td>-/-</td>
	</tr>
</table>

		<div class="clear"></div>
		</div>
	</div>
</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php } elseif($widget == "8" && $linked < 1){  ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
	mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','-1','2','8','defaultskin','20','20','".$zindex."')");

        $ret_sql = mysql_query("SELECT id FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $ret_row = mysql_fetch_assoc($ret_sql);
        $saved_id = $ret_row['id'];

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $saved_id . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$saved_id."-edit\", \"click\", function(e) { openEditMenu(e, ".$saved_id.", \"widget\", \"widget-".$saved_id."-edit\"); }, false);
	</script>\n";
?>

<div class="movable widget BadgesWidget" id="widget-<?php echo $saved_id ?>" style=" left: 20px; top: 20px; z-index: <?php echo $zindex; ?>;">
<div class="w_skin_defaultskin">
<div class="widget-corner" id="widget-<?php echo $saved_id ?>-handle">
<div class="widget-headline"><h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">Badges</span><span class="headerright">&nbsp;</span></h3>

</div>	
</div>
	
<div class="widget-body">
<div class="widget-content">
<div id="badgelist-content">

<?php

$sql = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$my_id."' ORDER BY badge_id ASC");
$count = mysql_num_rows($sql);
if($count == 0){
	echo "Diser User hat zurzeit keine Badges.";
}else{
	$widgetid = $saved_id;
	$bypass1 = true;
	include('./badgelist_badgepaging.php');

} ?>
        <script type="text/javascript">
        document.observe("dom:loaded", function() {
            window.badgesWidget<?php echo $row['id']; ?> = new BadgesWidget('<?php echo $count; ?>', '<?php echo $row['id']; ?>');
        });
        </script>

	</div>
	<div class="clear"></div>
	</div>
	</div>

</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php } elseif($widget == "9" && $linked < 1){ ?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php

	mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','-1','2','9','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '-1' AND type = '2' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $row = mysql_fetch_assoc($ret_sql);

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $row['id'] . "-edit\" />
	<script language=\"JavaScript\" type=\"text/javascript\">
	Event.observe(\"widget-".$row['id']."-edit\", \"click\", function(e) { openEditMenu(e, ".$row['id'].", \"widget\", \"widget-".$row['id']."-edit\"); }, false);
	</script>\n";

?>
<div class="movable widget RatingWidget" id="widget-<?php echo $row['id']; ?>" style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $widgetrow['z']; ?>;">
<div class="w_skin_<?php echo $row['skin']; ?>">
	<div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
		<div class="widget-headline"><h3><?php echo $edit; ?>

		<span class="header-left">&nbsp;</span><span class="header-middle">Meine Wertung</span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div>
	<div class="widget-body">
		<div class="widget-content">
	<div id="rating-main">

<script type="text/javascript">	
	var ratingWidget;
	document.observe("dom:loaded", function() { 
		ratingWidget = new RatingWidget(<?php echo $my_id; ?>, <?php echo $widgetrow['id']; ?>);
	}); 
</script><div class="rating-average">
		<b><?php echo $lang->loc['cast.vote']; ?></b>
	<div id="rating-stars" class="rating-stars" >
				<ul id="rating-unit_ul1" class="rating-unit-rating">
				<li class="rating-current-rating" style="width:0px;" />
					<li><a href="#"   class="r1-unit rater">1</a></li>
					<li><a href="#"   class="r2-unit rater">2</a></li>
					<li><a href="#"   class="r3-unit rater">3</a></li>
					<li><a href="#"   class="r4-unit rater">4</a></li>
					<li><a href="#"   class="r5-unit rater">5</a></li>
	
			</ul>	
	</div>
	0 Stimmen gesamt
	
	<br/>
	(0 Nutzer bewerten 4 und mehr)
</div>


	</div>
		<div class="clear"></div>
		</div>
	</div>
</div>
</div>

<?php
    } elseif($widget == "4" && $linked > 0){
        mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','".$groupid."','2','4','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '".$groupid."' AND type = '2' AND subtype = '5' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $ret_row = mysql_fetch_assoc($ret_sql);
        $saved_id = $ret_row['id'];

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $saved_id . "-edit\" />
<script language=\"JavaScript\" type=\"text/javascript\">
Event.observe(\"widget-".$saved_id."-edit\", \"click\", function(e) { openEditMenu(e, ".$saved_id.", \"widget\", \"widget-".$saved_id."-edit\"); }, false);
</script>\n";
	?>
	<div class="movable widget GuestbookWidget" id="widget-<?php echo $saved_id ?>" style=" left: 20px; top: 20px; z-index: <?php echo $zindex; ?>;">
<div class="w_skin_defaultskin">
	<div class="widget-corner" id="widget-<?php echo $saved_id ?>-handle">
		<div class="widget-headline"><h3>
		<?php echo $edit; ?>
		<span class="header-left">&nbsp;</span><span class="header-middle">Mein G&auml;stebuch(<span id="guestbook-size">0</span>) <span id="guestbook-type" class="public"><img src="./images/groups/status_exclusive.gif" title="Nur Freunde" alt="Friends only"/></span></span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div>
	<div class="widget-body">
		<div class="widget-content">
<div id="guestbook-wrapper" class="gb-public">
<ul class="guestbook-entries" id="guestbook-entry-container">
	<div id="guestbook-empty-notes">Dieses G&auml;stebuch hat noch keine Eintr&auml;ge.</div>
</ul></div>
<script type="text/javascript">	
	document.observe("dom:loaded", function() {
		var gb81481 = new GuestbookWidget('17570', '<?php echo $saved_id ?>', 500);
		var editMenuSection = $('guestbook-privacy-options');
		if (editMenuSection) {
			gb81481.updateOptionsList('public');
		}
	});
</script>
		<div class="clear"></div>
		</div>
	</div>
</div>
</div>
<?php
    } elseif($widget == "5" && $linked > 0){ 
        mysql_query("INSERT INTO homes_stickers (userid,groupid,type,subtype,skin,x,y,z) VALUES ('".$my_id."','".$groupid."','2','5','defaultskin','20','20','".$zindex."')") or die(mysql_error());

        $ret_sql = mysql_query("SELECT * FROM homes_stickers WHERE userid = '".$my_id."' AND groupid = '".$groupid."' AND type = '2' AND subtype = '5' ORDER BY id DESC LIMIT 1") or die(mysql_error());
        $ret_row = mysql_fetch_assoc($ret_sql);
        $saved_id = $ret_row['id'];

        $edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"widget-" . $saved_id . "-edit\" />
<script language=\"JavaScript\" type=\"text/javascript\">
Event.observe(\"widget-".$saved_id."-edit\", \"click\", function(e) { openEditMenu(e, ".$saved_id.", \"widget\", \"widget-".$saved_id."-edit\"); }, false);
</script>\n";
	?>
			<div class="movable widget TraxPlayerWidget" id="widget-<?php echo $saved_id ?>" style=" left: 20px; top: 20px; z-index: <?php echo $zindex; ?>;">
<div class="w_skin_defaultskin">
	<div class="widget-corner" id="widget-<?php echo $saved_id ?>-handle">
		<div class="widget-headline"><h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">TRAXPLAYER</span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div>
	<div class="widget-body">
		<div class="widget-content">
<?php 
$sql1 = mysql_query("SELECT * FROM soundmachine_songs WHERE current = '1' AND owner = '".$name."' LIMIT 1");
$songrow1 = mysql_fetch_assoc($sql); ?>
<div id="traxplayer-content" style="text-align: center;">
	<img src="./web-gallery/images/traxplayer/player.png"/>
</div>

<div id="edit-menu-trax-select-temp" style="display:none">
    <select id="trax-select-options-temp">
    <option value="">- Song ausw&auml;hlen -</option>
	<?php
	$mysql = mysql_query("SELECT * FROM furniture WHERE ownerid = '".$my_id."'");
	$i = 0;
	while($machinerow = mysql_fetch_assoc($mysql)){
		$i++;
		$sql = mysql_query("SELECT * FROM soundmachine_songs WHERE machineid = '".$machinerow['id']."'");
		$n = 0;
		while($songrow = mysql_fetch_assoc($sql)){
			$n++;
			if($songrow['id'] <> ""){ echo "		<option value=\"".$songrow['id']."\">".trim(nl2br(HoloText($songrow['title'])))."</option>\n"; }
		}
	} ?>
    </select>
</div>
		<div class="clear"></div>
		</div>
	</div>
</div>
	<?php
    }
} else { exit; }

?>