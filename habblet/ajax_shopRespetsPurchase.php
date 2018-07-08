<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$id = FilterText($_POST['optionNumber']);

$sql = mysql_query("SELECT * FROM cms_marktplatzrespects WHERE id = '".$id."' LIMIT 1");
$row = mysql_fetch_assoc($sql);

if($myrow['dolares'] < $row['dolares']){ $error = "Dólares"; }

if(isset($error)){
	$msg ="<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" style=\"margin: 10px;\" align=\"left\">
		<p>&iexcl;No tienes lo suficiente para comprar Los Respetos!</p>
 		<p>No tienes suficientes <b>".$error."</b> para comprar Los Respetos<br></p>
 		<p>Si no tienes suficientes Dólares, Puedes comprarlos en cualquier página de nuestra tienda.</a><br></p>";
}elseif($myrow['online'] == '0'){
                if($check < 1){
			mysql_query("UPDATE user_stats SET ".$row['name']." = ".$row['name']." + '".$row['count']."' WHERE id = '".$my_id."'") or die(mysql_error());
			mysql_query("UPDATE users SET dolares = dolares - '".$row['dolares']."' WHERE id = '".$my_id."'") or die(mysql_error());
			mysql_query("INSERT INTO cms_transactionsvip (userid,amount,date,descr) VALUES ('".$my_id."',-'".$row['dolares']."','".$date_full."','Compra de ".$row['count']." ".$row['description'].".')") or die(mysql_error());
			$msg = "&iexcl;Has comprado <img src=".$row['image']." align=right /> con &eacute;xito! ";
		}else{
			$msg = "&iexcl;Ya tienes este Respeto!";
		}
} else {
$msg = "<img src=\"".$path."/web-gallery/v2/images/frank_welcome.png\" align=\"right\">Tienes que estar Offline en el hotel para poder comprar respetos o caricias.<br><br>Porfavor desconéctate del hotel y vuelve a intentarlo.<br><br><br>";
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