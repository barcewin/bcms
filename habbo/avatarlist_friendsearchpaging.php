<?php

if($bypass == true){
$page = "1";
$search = "";
}else{
require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$page = FilterText($_POST['pageNumber']);
$search = FilterText($_POST['searchString']);
$widgetid = FilterText($_POST['widgetId']);

}

if($search == ""){
$sql = mysql_query("SELECT userid FROM homes_stickers WHERE id = '".$widgetid."' LIMIT 1");
$row1 = mysql_fetch_assoc($sql);
$user = $row1['userid'];
$offset = $page - 1;
$offset = $offset * 20;
$sql = mysql_query("SELECT * FROM messenger_friendships WHERE user_two_id = '".$user."' LIMIT 20 OFFSET ".$offset);
?>

<div class="avatar-widget-list-container">
<ul id="avatar-list-list" class="avatar-widget-list">

<?php

while($friendrow = mysql_fetch_assoc($sql)){
if($friendrow['user_one_id'] == $user){
	$user_two_id = $friendrow['user_two_id'];
}else{
	$user_two_id = $friendrow['user_one_id'];
}
	
$friend = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$user_two_id."' LIMIT 1"));
	
?>

<li id="avatar-list-<?php echo $widgetid; ?>-<?php echo $user_two_id; ?>" title="<?php echo $friend['username']; ?>"><div class="avatar-list-open"><a href="#" id="avatar-list-open-link-<?php echo $widgetid; ?>-<?php echo $user_two_id; ?>" class="avatar-list-open-link"></a></div>
<div class="avatar-list-avatar"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $friend['look']; ?>&size=s&direction=2&head_direction=2&gesture=sml" alt="" /></div>
<h4><a href="./home/<?php echo $friend['username']; ?>"><?php echo $friend['username']; ?></a></h4>
<p class="avatar-list-birthday"><?php echo date('d.m.Y', $friend['account_created']); ?></p>
<p>

</p></li>

<?php } ?>
</ul>

<div id="avatar-list-info" class="avatar-list-info">
<div class="avatar-list-info-close-container"><a href="#" class="avatar-list-info-close"></a></div>
<div class="avatar-list-info-container"></div>
</div>

</div>

<div id="avatar-list-paging">
<?php
$sql = mysql_query("SELECT * FROM messenger_friendships WHERE user_two_id = '".$user."'");
$count = mysql_num_rows($sql);
$at = $page - 1;
$at = $at * 20;
$at = $at + 1;
$to = $offset + 20;
if($to > $count){ $to = $count; }
$totalpages = ceil($count / 20);
?>
    <?php echo $at; ?> - <?php echo $to; ?> / <?php echo $count; ?>
    <br/>
	<?php if($page != 1){ ?>
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-first" >Erster</a> |
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-previous" >&lt;&lt;</a> |
	<?php }else{ ?>
	Erster |
    &lt;&lt; |
	<?php } ?>
	<?php if($page != $totalpages){ ?>
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-next" >&gt;&gt;</a> |
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-last" >Letzter</a>
	<?php }else{ ?>
	&gt;&gt; |
    Letzter
	<?php } ?>
<input type="hidden" id="pageNumber" value="<?php echo $page; ?>"/>
<input type="hidden" id="totalPages" value="<?php echo $totalpages; ?>"/>
</div>
<?php }else{
$sql = mysql_query("SELECT userid FROM homes_stickers WHERE id = '".$widgetid."' LIMIT 1");
$row1 = mysql_fetch_assoc($sql);
$user = $row1['userid'];
$offset = $page - 1;
$offset = $offset * 10;
$sql = mysql_query("SELECT users.id,users.username,users.look,users.account_created FROM users,messenger_friendships WHERE messenger_friendships.user_one_id = users.id AND messenger_friendships.user_two_id = '".$user."' AND users.username LIKE '%".$search."%' LIMIT 10 OFFSET ".$offset);
?>
<div class="avatar-widget-list-container">
<ul id="avatar-list-list" class="avatar-widget-list">

<?php while($friendrow = mysql_fetch_assoc($sql)){ ?>

	<li id="avatar-list-<?php echo $widgetid; ?>-<?php echo $friendrow['id']; ?>" title="<?php echo $friendrow['username']; ?>"><div class="avatar-list-open"><a href="#" id="avatar-list-open-link-<?php echo $widgetid; ?>-<?php echo $friendrow; ?>" class="avatar-list-open-link"></a></div>
<div class="avatar-list-avatar"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $friendrow['look']; ?>&size=s&direction=2&head_direction=2&gesture=sml" alt="" /></div>
<h4><a href="./home/<?php echo $friendrow['username']; ?>"><?php echo $friendrow['username']; ?></a></h4>
<p class="avatar-list-birthday"><?php echo date('d.m.Y', $friendrow['account_created']); ?></p>
<p>

</p></li>

<?php }  ?>
</ul>

<div id="avatar-list-info" class="avatar-list-info">
<div class="avatar-list-info-close-container"><a href="#" class="avatar-list-info-close"></a></div>
<div class="avatar-list-info-container"></div>
</div>

</div>

<div id="avatar-list-paging">
<?php
$count = mysql_num_rows($sql);
$offset = $offset * 2;
$at = $page - 1;
$at = $at * 20;
$at = $at + 1;
$to = $offset + 20;
if($to > $count){ $to = $count; }
$totalpages = ceil($count / 20);
?>
    <?php echo $at; ?> - <?php echo $to; ?> / <?php echo $count; ?>
    <br/>
	<?php if($page != 1){ ?>
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-first" >Eerder</a> |
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-previous" >&lt;&lt;</a> |
	<?php }else{ ?>
	Erster |
    &lt;&lt; |
	<?php } ?>
	<?php if($page != $totalpages){ ?>
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-next" >&gt;&gt;</a> |
    <a href="#" class="avatar-list-paging-link" id="avatarlist-search-last" >Letzter</a>
	<?php }else{ ?>
	&gt;&gt; |
    Letzter
	<?php } ?>
<input type="hidden" id="pageNumber" value="<?php echo $page; ?>"/>
<input type="hidden" id="totalPages" value="<?php echo $totalpages; ?>"/>
</div>
<?php } ?>