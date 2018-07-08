<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$key = FilterText($_GET['key']);

switch($key){
	case "friends_all": $mode = 1; break;
	case "groups": $mode = 2; break;
	case "rooms": $mode = 3; break;
}

if(!isset($mode) || !isset($key)){ $mode = 1; }

switch($mode){
	case 1:
		$str = "Freunde";
		$get_em = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$my_id."' LIMIT 500") or die(mysql_error());
		break;
	case 2:
		$str = "Gruppen";
		$get_em = mysql_query("SELECT * FROM group_members WHERE id_user = '".$my_id."' ORDER BY rank LIMIT 10") or die(mysql_error());
		break;
	case 3:
		$str = "R&auml;ume";
		$get_em = mysql_query("SELECT * FROM rooms WHERE owner  = '".$name."' ORDER BY caption ASC LIMIT 100") or die(mysql_error());
		break;
}

$results = mysql_num_rows($get_em);
$oddeven = 0;

if($results > 0){
	if($mode == 1){ ?>
		  
	<div class="qtab-subtitle odd"><div class="qtab-category">Freunde</div></div>
	<ul id="online-friends">
	<?php   while ($row = mysql_fetch_assoc($get_em)){
			$userdatasql = mysql_query("SELECT * FROM users WHERE id = '".$row['user_two_id']."' ORDER BY username ASC LIMIT 1") or die(mysql_error());
			$user_exists = mysql_num_rows($userdatasql);
				if($user_exists > 0){
					$userrow = mysql_fetch_assoc($userdatasql);
					$oddeven++;
					if(IsEven($oddeven)){
						$even = "odd"; 
					} else {
						$even = "even"; 
					}

					if($userrow['online'] >= 1){
						echo"<img src=\"../web-gallery/images/myhabbo/habbo_online_anim_big.gif\" align=\"right\" style=\"margin-right: 10px\">";
					}else{
						echo"<img src=\"../web-gallery/images/myhabbo/habbo_offline_big.gif\" align=\"right\" style=\"margin-right: 10px\">"; 
					} ?>
					<li class="<?php echo $even; ?>">	
<a href="../home/<?php echo $userrow['username']; ?>"><?php echo $userrow['username']; ?></a></li>
				
			<?php } } ?>
	</ul>

<p class="manage-friends"><a href="/profile/6">Freunde verwalten</a></p></div>
<?php
		} elseif($mode == 2){
		echo "<ul id=\"quickmenu-groups\">\n";

		$num = 0;

			while($row = mysql_fetch_assoc($get_em)){

				$num++;

				$check = mysql_query("SELECT * FROM group_details WHERE id = '".$row['id_group']."' LIMIT 1") or die(mysql_error());
				$groupdata = mysql_fetch_assoc($check);

				echo "<li class=\"";
				if(IsEven($num)){ echo "odd"; } else { echo "even"; }
				echo "\">"; ?>

				<?php if($row['is_current'] == 1){ ?><div class="favourite-group" title="Favourite"></div><?php } ?>
				<?php if($row['rank'] > 1 && $groupdata['ownerid'] !== $my_id){ ?> <div class="admin-group" title="Admin"></div><?php } ?>
				<?php if($groupdata['ownerid'] == $my_id && $row['rank'] > 1){ ?> <div class="owned-group" title="Besitzer"></div><?php } ?>

				<a href="<?php echo $path; ?>/groups/<?php echo $row['id_group']; ?>"><?php echo HoloText($groupdata['name']); ?></a></li>
			<?php }

		echo "\n</ul>";
		} elseif($mode == 3){
		echo "<ul id=\"quickmenu-rooms\">\n";
			while ($row = mysql_fetch_assoc($get_em)){
			$oddeven++;
			if(IsEven($oddeven)){ $even = "odd"; } else { $even = "even"; }
			printf("<li class=\"%s\"><a href=\"client.php?forwardId=2&amp;roomId=%s\" onclick=\"roomForward(this, '%s', 'private'); return false;\" target=\"client\" id=\"room-navigation-link_%s\">%s</a> </li>\n",$even,$row['id'],$row['id'],$row['id'],$row['caption']);
			}
		echo "\n</ul>";
		} else {
		echo "Invalid mode";
		}
	} else {
		echo "<ul id=\"quickmenu-" . $str . "\">\n	<li class=\"odd\">Du hast zurzeit keine " . $str . "</li>\n</ul>";
	}

	if($mode == "3"){
	echo "<p class=\"create-room\"><a href=\"client.php?shortcut=roomomatic\" onclick=\"HabboClient.openShortcut(this, 'roomomatic'); return false;\" target=\"client\">Kostenlos ein Raum erstellen</a></p>";
	} elseif($mode == "2"){
	echo "<p class=\"create-group\"><a href=\"#\" onclick=\"GroupPurchase.open(); return false;\">Gruppe erstellen</a></p>";
	}

?>