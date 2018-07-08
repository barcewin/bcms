<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$refer = $_SERVER['HTTP_REFERER'];
$pos = strrpos($refer, "groups");
if($pos === false){
	exit;
}

$groupid = FilterText($_POST['groupId']);
$page = FilterText($_POST['pageNumber']);
$searchString = FilterText($_POST['searchString']);
$pending = FilterText($_POST['pending']);

if($pending == "true"){
	$pending = true;
} else {
	$pending = false;
}

if(!is_numeric($groupid)){ 
	exit;
}

$check = mysql_query("SELECT * FROM group_members WHERE id_user = '".$my_id."' AND id_group = '".$groupid."' AND rank > 1 AND is_pending = '0' LIMIT 1");
if(mysql_num_rows($check) > 0){
	$my_membership = mysql_fetch_assoc($check);
	$member_rank = $my_membership['rank'];
	if($member_rank < 2){
		exit;
	}
} else {
	exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1");

if(mysql_num_rows($check) > 0){
	$groupdata = mysql_fetch_assoc($check);
} else {
	exit;
}

$members = mysql_evaluate("SELECT COUNT(*) FROM group_members WHERE id_group = '".$groupid."' AND is_pending = '0'") or die();
$members_pending = mysql_evaluate("SELECT COUNT(*) FROM group_members WHERE id_group = '".$groupid."' AND is_pending = '1'");

$pages = ceil($members / 12);
$pages_pending = ceil($members_pending / 12);

$page = FilterText($_POST['pageNumber']);

if($pending == true){
        $totalPagesMemberList = $pages_pending;
        $totalMembers = $members_pending;
        if($page < 1 || empty($page) || $page > $pages_pending){ $page = 1; }
} else {
        $totalPagesMemberList = $pages;
        $totalMembers = $members;
        if($page < 1 || empty($page) || $page > $pages){ $page = 1; }
}

$queryLimitMin = ($page * 12) - 12;
$queryLimit = $queryLimitMin . ",12";

header("X-JSON: {\"pending\":\"Anh&auml;nger (" . $members_pending . ")\",\"miembros\":\"Mitglieder (" . $members . ")\"}");

?>

<div id="group-memberlist-members-list">

<form method="post" action="#" onsubmit="return false;">
<ul class="habblet-list two-cols clearfix">

<?php

$counter = 0;
if($pending == true){
	if($members_pending < 1){
		echo "No hay miembros pendientes.";
	} else {
		$get_memberships = mysql_query("SELECT * FROM group_members WHERE id_group = '".$groupid."' AND is_pending = '1' ORDER BY rank DESC LIMIT ".$queryLimit."");
		while($membership = mysql_fetch_assoc($get_memberships)){

		if(!is_numeric($membership['id_user'])){
			exit;
		}

		$get_userdata = mysql_query("SELECT * FROM users WHERE id = '".$membership['id_user']."' LIMIT 1");
		if(mysql_num_rows($get_userdata) > 0){
			$counter++;
			$userdata = mysql_fetch_assoc($get_userdata);

			if(IsEven($counter)){ $pos = "right"; $rights++; } else { $pos = "left"; $lefts++; }
			if(IsEven($lefts)){ $oddeven = "odd"; } else { $oddeven = "even"; }

?>

<li class="<?php echo $oddeven; ?> online <?php echo $pos; ?>">
<div class="item" style="padding-left: 5px; padding-bottom: 4px;">
<div style="float: right; width: 16px; height: 16px; margin-top: 1px">

<?php

if($membership['id_user'] == $groupdata['ownerid']){
	echo"<img src=\"".$path."/web-gallery/images/groups/owner_icon.gif\" width=\"15\" height=\"15\" alt=\"Due&ntilde;o\" title=\"Due&ntilde;o\" />\n";
}elseif($membership['rank'] > 1){
	echo"<img src=\"".$path."/web-gallery/images/groups/administrator_icon.gif\" width=\"15\" height=\"15\" alt=\"Administrador\" title=\"Administrador\" />";
}


echo"</div>
<input id=\"group-memberlist-m-".$userdata['id']."\" type=\"checkbox\""; 
if($membership['id_user'] == $groupdata['ownerid'] || $membership['id_user'] == $my_id){
	echo" disabled=\"disabled\"";
} 
echo" style=\"margin: 0; padding: 0; vertical-align: middle\"/>
<a class=\"home-page-link\" href=\"".$path."/home/".$userdata['username']."\"><span>".$userdata['username']."</span></a>
</div>
</li>";

}
}
}

	} else {
		if($members < 1){
			echo "No hay miembros en este grupo.";
		} else {
			$get_memberships = mysql_query("SELECT * FROM group_members WHERE id_group = '".$groupid."' AND is_pending = '0' ORDER BY rank DESC LIMIT ".$queryLimit."");
			while($membership = mysql_fetch_assoc($get_memberships)){
                                $tinyrank = "m";
				if(!is_numeric($membership['id_user'])){
					exit;
				}
				$get_userdata = mysql_query("SELECT * FROM users WHERE id = '".$membership['id_user']."' LIMIT 1") or die(mysql_error());
				$valid_user = mysql_num_rows($get_userdata);
				if($valid_user > 0){
					$counter++;
					$userdata = mysql_fetch_assoc($get_userdata);
					if(IsEven($counter)){ $pos = "right"; $rights++; } else { $pos = "left"; $lefts++; }
					if(IsEven($lefts)){ $oddeven = "odd"; } else { $oddeven = "even"; }
?>

<li class="<?php echo $oddeven; ?> online <?php echo $pos; ?>">
<div class="item" style="padding-left: 5px; padding-bottom: 4px;">
<div style="float: right; width: 16px; height: 16px; margin-top: 1px">

<?php

if($membership['id_user'] == $groupdata['ownerid']){
	$tinyrank = "a"; 
	echo "<img src=\"".$path."/web-gallery/images/groups/owner_icon.gif\" width=\"15\" height=\"15\" alt=\"Due&ntilde;o\" title=\"Due&ntilde;o\" />\n"; 
}elseif($membership['rank'] > 1){
	$tinyrank = "a";
	echo "<img src=\"".$path."/web-gallery/images/groups/administrator_icon.gif\" width=\"15\" height=\"15\" alt=\"Administrador\" title=\"Administrador\" />";
}

echo "</div>
<input id=\"group-memberlist-".$tinyrank."-".$userdata['id']."\" type=\"checkbox\"";
if($membership['id_user'] == $groupdata['ownerid']){
	echo " disabled=\"disabled\"";
} 
echo " style=\"margin: 0; padding: 0; vertical-align: middle\"/>
<a class=\"home-page-link\" href=\"".$path."/home/".$userdata['username']."\"><span>".$userdata['username']."</span></a>
</div>
</li>";

}
}
}
}
        
$results = @mysql_num_rows($get_memberships);
		
echo "
</ul>
</form>

</div>
<div id=\"member-list-pagenumbers\">
".($queryLimitMin + 1)." - ".($results + $queryLimitMin)." / ".$totalMembers."
</div>
<div id=\"member-list-paging\" >";
if($page > 1){ echo "<a href=\"#\" class=\"avatar-list-paging-link\" id=\"memberlist-search-first\" >Primero</a>"; } else { echo "Primero"; }
echo " | ";
if($page > 1){ echo "<a href=\"#\" class=\"avatar-list-paging-link\" id=\"memberlist-search-previous\" >&lt;&lt;</a>"; } else { echo "&lt;&lt;"; }
echo " | ";
if($page < $totalPagesMemberList){ echo "<a href=\"#\" class=\"avatar-list-paging-link\" id=\"memberlist-search-next\" >&gt;&gt;</a>"; } else { echo "&gt;&gt;"; }
echo " | ";
if($page < $totalPagesMemberList){ echo "<a href=\"#\" class=\"avatar-list-paging-link\" id=\"memberlist-search-last\" >&Uacute;ltimo</a>"; } else { echo "&Uacute;ltimo"; }
echo "<input type=\"hidden\" id=\"pageNumberMemberList\" value=\"".$page."\"/>
<input type=\"hidden\" id=\"totalPagesMemberList\" value=\"".$totalPagesMemberList."\"/>
</div>";