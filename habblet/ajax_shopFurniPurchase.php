<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$id = FilterText($_POST['optionNumber']);

$sql = mysql_query("SELECT * FROM cms_marktplatzfurni WHERE id = '".$id."' LIMIT 1");
$row = mysql_fetch_assoc($sql);

if($myrow['credits'] < $row['credits']){ $error = "Cr&eacute;ditos"; }
if($myrow['activity_points'] < $row['pixels']){ $error = "Duckets"; }
if($myrow['vip_points'] < $row['vip_points']){ $error = "Diamantes"; }

if(isset($error)){
	$msg ="<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" style=\"margin: 10px;\" align=\"left\">
		<p>&iexcl;No tienes los suficientes cr&eacute;ditos, duckets o diamantes para obtener este rare!</p>
 		<p>No tienes suficientes <b>".$error."</b> para comprar este Rare.<br></p>
 		<p>Si no tienes suficientes Cr&eacute;ditos/Duckets/Diamantes, haz clic <a href=\"".$path."/credits\">aqu&iacute;</a><br></p>";
}elseif($myrow['online'] == '0'){
		$check2 = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$my_id."' AND badge_id = '".$row['image']."'");
		$check = mysql_num_rows($check2);
                if($check < 1){

$sqlitem;

$itemid1 = mysql_query("SELECT * FROM `items` ORDER BY id DESC LIMIT 1");
$itemid = mysql_fetch_array($itemid1);
$mas = 1;
$iditem = $itemid['id'] + $mas;


			mysql_query("UPDATE users SET credits = credits - '".$row['credits']."', activity_points = activity_points - '".$row['pixels']."', vip_points = vip_points - '".$row['vip_points']."' WHERE id = '".$my_id."'") or die(mysql_error());
			mysql_query("INSERT INTO items (id,user_id,room_id,base_item,extra_data,x,y,z,rot,wall_pos) VALUES ('".$iditem."','".$my_id."','0','".$row['image']."','0','0','0','0','0','0')") or die(mysql_error());
			mysql_query("INSERT INTO cms_transactions (userid,amount,date,descr) VALUES ('".$my_id."',-'".$row['credits']."','".$date_full."','Compra de un(a) ".$row['name'].".')") or die(mysql_error());
			$msg = "&iexcl;Has comprado un(a) <b>".$row['name']."</b> con &eacute;xito!";
		}else{
			$msg = "&iexcl;Ya tienes este Rare!";
		}
} else {
$msg = "<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" align=\"right\">Debes estar fuera del client antes de comprar. <br><br>Porfavor cierra la pestaña del client y vuelve a intentarlo.<br><br><br>";
}

?>
<div class="roomblue">
<div id="hc_confirm_box">

<p><?php echo $msg; ?></p>
<p>
<a href="#" class="btn medium green" onclick="habboclub.closeSubscriptionWindow(); return false;">
<b>Continuar</b><i></i></a>
</p>

</div>

<div class="clear"></div>