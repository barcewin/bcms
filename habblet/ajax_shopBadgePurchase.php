<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$id = FilterText($_POST['optionNumber']);

$sql = mysql_query("SELECT * FROM cms_marktplatz WHERE id = '".$id."' LIMIT 1");
$row = mysql_fetch_assoc($sql);

if($myrow['credits'] < $row['credits']){ $error = "Cr&eacute;ditos"; }
if($myrow['activity_points'] < $row['pixels']){ $error = "Duckets"; }
if($myrow['vip_points'] < $row['pixels']){ $error = "Diamantes"; }

if(isset($error)){
	$msg ="<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" style=\"margin: 10px;\" align=\"left\">
		<p>&iexcl;No tienes lo suficiente para comprar esta Placa!</p>
 		<p>No tienes suficientes <b>".$error."</b> para comprar esta Placa<br></p>
 		<p>Si no tienes suficientes Cr&eacute;ditos/Duckets/Diamantes, haz clic <a href=\"".$path."/credits\">aqu&iacute;</a><br></p>";
}elseif($myrow['online'] == '0'){
		$check2 = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$my_id."' AND badge_id = '".$row['image']."'");
		$check = mysql_num_rows($check2);
                if($check < 1){
			mysql_query("INSERT INTO user_badges (user_id,badge_id,badge_slot) VALUES ('".$my_id."','".$row['image']."','0')");
			mysql_query("UPDATE users SET credits = credits - '".$row['credits']."', activity_points = activity_points - '".$row['pixels']."', vip_points = vip_points - '".$row['vip_points']."' WHERE id = '".$my_id."'") or die(mysql_error());
			mysql_query("INSERT INTO cms_transactions (userid,amount,date,descr) VALUES ('".$my_id."',-'".$row['credits']."','".$date_full."','Compra de la Placa ".$row['image'].".')") or die(mysql_error());
			$msg = "&iexcl;Has comprado la Placa <b>".$row['image']."</b> con &eacute;xito!";
		}else{
			$msg = "&iexcl;Ya tienes esta Placa!";
		}
} else {
$msg = "<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" align=\"right\">Tienes que estar Offline en el hotel para poder comprar cualquier tipo de placa.<br><br>Porfavor descon&eacute;ctate del hotel y vuelve a intentarlo.<br><br><br>";
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