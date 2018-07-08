<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$id = FilterText($_POST['optionNumber']);
$row = mysql_fetch_assoc(mysql_query("SELECT * FROM cms_marktplatz WHERE id = '".$id."' LIMIT 1"));

?>
<div class="roomblue">
<div id="hc_confirm_box">

    <img src="<?php echo $cimagesurl.$badgesurl.$row['image'].".gif"; ?>" alt="" align="right" style="margin:10px;" />

<p>Est&aacute;s a punto de comprar esta Placa. &iexcl;Genial!</p>
<p>Placa: <b><?php echo $row['image']; ?></b></p>
<p>Precio: <b><?php echo $row['credits']; ?> Cr&eacute;ditos / <?php echo $row['pixels']; ?> Duckets / <?php echo $row['vip_points']; ?> Diamantes</b></p>
<p>Dispones de: <b><?php echo $myrow['credits']; ?> Cr&eacute;ditos / <?php echo $myrow['activity_points']; ?> Duckets / <?php echo $myrow['vip_points']; ?> Diamantes</b></p>
<p>
<a href="#" class="btn medium green" onclick="habboclub.closeSubscriptionWindow(); return false;">
<b>Cancelar</b><i></i></a>
<a href="#" ondblclick="habboclub.showSubscriptionResultWindow(<?php echo $id; ?>,'¡Placa Comprada!'); return false;" onclick="habboclub.showSubscriptionResultWindow(<?php echo $id; ?>,'Compra de Placa'); return false;" class="btn medium green">
<b>Comprar</b><i></i></a>
</p>

</div>

<div class="clear"></div>