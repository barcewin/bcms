<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$ownerid = $_GET['ownerId'];
$widgetid = $_GET['ratingId'];

if($ownerid == $my_id){
	mysql_query("DELETE FROM homes_ratings WHERE userid = '".$ownerid."'");
	echo"SUCCES";
}
?>
<script type="text/javascript">	
	var ratingWidget;
	 
		ratingWidget = new RatingWidget(<?php echo HoloText($ownerid); ?>, <?php echo HoloText($widgetid); ?>);
	 
</script><div class="rating-average">
		<b>Durchschnittliche Wertung: 0</b><br/>
	<div id="rating-stars" class="rating-stars" >
				<ul id="rating-unit_ul1" class="rating-unit-rating">
				<li class="rating-current-rating" style="width:0px;" />
	
			</ul>	
	</div>
	0 Stimmen gesammt
	
	<br/>
	(0 Nutzer bewerten 4 und mehr)
</div>