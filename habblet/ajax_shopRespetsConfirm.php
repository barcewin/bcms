<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$id = FilterText($_POST['optionNumber']);
$row = mysql_fetch_assoc(mysql_query("SELECT * FROM cms_marktplatzrespects WHERE id = '".$id."' LIMIT 1"));

?>

<div id="hc_confirm_box">

<p>Est&aacute;s a punto de comprar. <img src=<?php echo $row['image']; ?> align=right /> ¡Genial! </p>
<p>Precio: <b><?php echo $row['dolares']; ?> Dólares</b></p>
<p>Dispones de: <b><?php echo $myrow['dolares']; ?> Dólares</b></p>
<p>
<a href="#" class="new-button" onclick="habboclub.closeSubscriptionWindow(); return false;">
<b>Cancelar</b><i></i></a>
<a href="#" ondblclick="habboclub.showSubscriptionResultWindow(<?php echo $id; ?>,'¡Respetos Comprados!'); return false;" onclick="habboclub.showSubscriptionResultWindow(<?php echo $id; ?>,'Compra de Respetos'); return false;" class="new-button">
<b>Comprar</b><i></i></a>
</p>

</div>

<div class="clear"></div>