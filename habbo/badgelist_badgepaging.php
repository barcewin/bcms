<?php

if($bypass1 == true){
	$page = "1";
}else{
	require_once('../data_classes/server-data.php_data_classes-core.php.php');
	require_once('../data_classes/server-data.php_data_classes-session.php.php');
	$page = FilterText($_POST['pageNumber']);
	$widgetid = FilterText($_POST['widgetId']);
}

$sql = mysql_query("SELECT userid FROM homes_stickers WHERE id = '".$widgetid."' LIMIT 1") or die(mysql_error());
$rrow1 = mysql_fetch_assoc($sql);
$user = $rrow1['userid'];
$offset = $page - 1;
$offset = $offset * 16;
$sql = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$user."' ORDER BY badge_slot DESC LIMIT 16 OFFSET ".$offset) or die(mysql_error());
?>
    <ul class="clearfix">
	<?php while($rrow = mysql_fetch_assoc($sql)){ ?>
            <li style="background-image: url(<?php echo $cimagesurl.$badgesurl.$rrow['badge_id'].".gif"; ?>)"></li>
    <?php } ?>
    </ul>

<div id="badge-list-paging">
<?php
$sql = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$user."' ORDER BY badge_slot DESC") or die(mysql_error());
$count = mysql_num_rows($sql);
$offset = $offset * 2;
$at = $page - 1;
$at = $at * 16;
$at = $at + 1;
$to = $offset + 16;
if($to > $count){ $to = $count; }
$totalpages = ceil($count / 16);
?>
    <?php echo $at; ?> - <?php echo $to; ?> / <?php echo $count; ?>
    <br/>
	<?php if($page != 1){ ?>
    <a href="#" id="badge-list-search-first" >Erster</a> |
    <a href="#" id="badge-list-search-previous" >&lt;&lt;</a> |
	<?php }else{ ?>
	Erster |
    &lt;&lt; |
	<?php } ?>
	<?php if($page != $totalpages){ ?>
    <a href="#" id="badge-list-search-next" >&gt;&gt;</a> |
    <a href="#" id="badge-list-search-last" >Letzter</a>
	<?php }else{ ?>
	&gt;&gt; |
    Letzter
	<?php } ?>
<input type="hidden" id="badgeListPageNumber" value="<?php echo $page; ?>"/>
<input type="hidden" id="badgeListTotalPages" value="<?php echo $totalpages; ?>"/>
</div>