<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$hid = FilterText($_GET['hid']);
$first = FilterText($_GET['first']);
?>
<?php if($hid == "h120"){ ?>
<head>

</head>
<div id="rooms-habblet-list-container-h120" class="recommendedrooms-lite-habblet-list-container">
        <ul class="habblet-list">
<?php
$i = 0;
$getem = mysql_query("SELECT * FROM rooms ORDER BY score DESC LIMIT 5") or die(mysql_error());

while ($row = mysql_fetch_assoc($getem)) {
    	 $i++;

        if(IsEven($i)){
            $even = "odd";
        } else {
            $even = "even";
        }

	$roomcount = $row['users_now'] / $row['users_max'] * 100;
	if($roomcount == 99 || $roomcount > 99){
		$rl = 5;
	} elseif($roomcount > 65){
		$rl = 4;
	} elseif($roomcount > 32){
		$rl = 3;
	} elseif($roomcount > 0){
		$rl = 2;
	} elseif($roomcount < 1){
		$rl = 1;
	}

        printf("<li class=\"%s\">
    <span class=\"clearfix enter-room-link room-occupancy-%s\" title=\"Go to room\" roomid=\"%s\">
	    <span class=\"room-enter\">Betreten</span>
	    <span class=\"room-name\">%s</span>
	    <span class=\"room-description\">%s</span>
		<span class=\"room-owner\">Besitzer: <a href=\"".$path."/home/%s\">%s</a></span>
    </span>

</li>", $even, $rl, $row['id'], HoloText($row['caption']), FilterText($row['description']), $row['owner'], $row['owner']);
    }
?>

        </ul>
            <div id="room-more-data-h120" style="display: none">
                <ul class="habblet-list room-more-data">

<?php
$i = 0;
$getem = mysql_query("SELECT * FROM rooms ORDER BY score DESC LIMIT 15 OFFSET 5") or die(mysql_error());

while ($row = mysql_fetch_assoc($getem)) {
        $i++;

        if(IsEven($i)){
            $even = "odd";
        } else {
            $even = "even";
        }
	
	$get_owner = mysql_query("SELECT username FROM users WHERE id = '".$row['owner']."'");
	$owner = mysql_fetch_assoc($get_owner);

	$roomcount = $row['users_now'] / $row['users_max'] * 100;
	if($roomcount == 99 || $roomcount > 99){
		$rl = 5;
	} elseif($roomcount > 65){
		$rl = 4;
	} elseif($roomcount > 32){
		$rl = 3;
	} elseif($roomcount > 0){
		$rl = 2;
	} elseif($roomcount < 1){
		$rl = 1;
	}

        printf("<li class=\"%s\">
    <span class=\"clearfix enter-room-link room-occupancy-%s\" title=\"Go to room\" roomid=\"%s\">
	    <span class=\"room-enter\">Betreten</span>
	    <span class=\"room-name\">%s</span>
	    <span class=\"room-description\">%s</span>
		<span class=\"room-owner\">Besitzer: <a href=\"".$path."/home/%s\">%s</a></span>
    </span>

</li>", $even, $rl, $row['id'], HoloText($row['caption']), FilterText($row['description']), $row['owner'], $row['owner']);
    }
?>
                </ul>
            </div>
            <div class="clearfix">
                <a href="#" class="room-toggle-more-data" id="room-toggle-more-data-h120">Mehr R&auml;ume anzeigen</a>
            </div>
</div>
<script type="text/javascript">
L10N.put("show.more", "Mehr R&auml;ume anzeigen");
L10N.put("show.less", "Weniger R&auml;ume anzeigen");
var roomListHabblet_h120 = new RoomListHabblet("rooms-habblet-list-container-h120", "room-toggle-more-data-h120", "room-more-data-h120");
</script>
<?php }elseif($hid == "h122"){ ?>
<head>
<script src="../web-gallery/static/js/moredata.js" type="text/javascript"></script>
</head>
<div id="hotgroups-habblet-list-container" class="habblet-list-container groups-list">
    <ul class="habblet-list two-cols clearfix">
<?php
$i = 0;
$j = 1;
$getem = mysql_query("SELECT * FROM group_details ORDER BY views DESC LIMIT 10") or die(mysql_error());

while ($row = mysql_fetch_assoc($getem)) {
        $i++;

        if(IsEven($i)){
            $left = "right";
        } else {
            $left = "left";
			$j++;
        }
		
        if(IsEven($j)){
            $even = "even";
        } else {
            $even = "odd";
        }

?>

<li class="<?php echo $even; ?> <?php echo $left; ?>" style="background-image: url(<?php echo $path; ?>/habbo-imaging/badge.php?badge=<?php echo $row['badge']; ?>)">
                <a class="item" href="<?php echo $path; ?>/groups/<?php echo $row['id']; ?>"><span class="index"><?php echo $i; ?>.</span> <?php echo HoloText($row['name']); ?></a>
            </li>

<?php } ?>

</ul>
    <div id="hotgroups-list-hidden-h122" style="display: none">
    <ul class="habblet-list two-cols clearfix">
<?php
$i = 10;
$j = 1;
$getem = mysql_query("SELECT * FROM group_details ORDER BY views DESC LIMIT 40 OFFSET 10") or die(mysql_error());

while ($row = mysql_fetch_assoc($getem)) {
        $i++;

        if(IsEven($i)){
            $left = "left";
        } else {
            $left = "right";
			$j++;
        }
		
        if(IsEven($j)){
            $even = "odd";
        } else {
            $even = "even";
        }

?>

<li class="<?php echo $even; ?> <?php echo $left; ?>" style="background-image: url(<?php echo $path; ?>/habbo-imaging/badge.php?badge=<?php echo $row['badge']; ?>)">
                <a class="item" href="<?php echo $path; ?>/groups/<?php echo $row['id']; ?>"><span class="index"><?php echo $i; ?>.</span> <?php echo HoloText($row['name']); ?></a>
            </li>

<?php } ?>

</ul>
</div>
    <div class="clearfix">
        <a href="#" class="hotgroups-toggle-more-data secondary" id="hotgroups-toggle-more-data-h122">Mehr Gruppen anzeigen</a>
    </div>
<script type="text/javascript">
L10N.put("show.more.groups", "Mehr Gruppen anzeigen");
L10N.put("show.less.groups", "Weniger Gruppen anzeigen");
var hotGroupsMoreDataHelper = new MoreDataHelper("hotgroups-toggle-more-data-h122", "hotgroups-list-hidden-h122","groups");
</script>
</div>
<?php } ?>