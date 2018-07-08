<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$id = FilterText($_POST['optionNumber']);

$sql = mysql_query("SELECT * FROM cms_marktplatzfurnivip WHERE id = '".$id."' LIMIT 1");
$row = mysql_fetch_assoc($sql);

if($myrow['dolares'] < $row['dolares']){ $error = "Dólares"; }

if(isset($error)){
	$msg ="<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" style=\"margin: 10px;\" align=\"left\">
		<p>&iexcl;No tienes lo suficiente para comprar este Rare!</p>
 		<p>No tienes suficientes <b>".$error."</b> para comprar este Rare<br></p>
 		<p>Si no tienes suficientes Dólares, puedes comprarlo en cualquier página de nuestra tienda.</a><br></p>";
}elseif($myrow['online'] == '0'){
		$check2 = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$my_id."' AND badge_id = '".$row['image']."'");
		$check = mysql_num_rows($check2);
                if($check < 1){

$sqlitem;

$itemid1 = mysql_query("SELECT * FROM `items` ORDER BY id DESC LIMIT 1");
$itemid = mysql_fetch_array($itemid1);
$mas = 1;
$iditem = $itemid['id'] + $mas;


			mysql_query("INSERT INTO items (id,user_id,room_id,base_item,extra_data,x,y,z,rot,wall_pos) VALUES ('".$iditem."','".$my_id."','0','".$row['image']."','0','0','0','0','0','0')");
			mysql_query("UPDATE users SET dolares = dolares - '".$row['dolares']."' WHERE id = '".$my_id."'") or die(mysql_error());
			mysql_query("INSERT INTO cms_transactionsvip (userid,amount,date,descr) VALUES ('".$my_id."',-'".$row['dolares']."','".$date_full."','Compra de un(a) ".$row['name'].".')") or die(mysql_error());
			$msg = "&iexcl;Has comprado un(a) <b>".$row['name']."</b> con &eacute;xito!";
		}else{
			$msg = "&iexcl;Ya tienes este Mega Rare!";
		}
} else {
$msg = "<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" align=\"right\">Tienes que estar Offline en el hotel para poder comprar cualquier tipo de Rare. <br><br>Porfavor descon&eacute;ctate y vuelve a intentarlo.<br><br><br>";
}

?>

<div id="hc_confirm_box">


<p><?php echo $msg; ?></p>
<p>
<a href="#" class="new-button" onclick="habboclub.closeSubscriptionWindow(); return false;">
<b>Continuar</b><i></i></a>
</p>

</div>

<div class="clear"></div>