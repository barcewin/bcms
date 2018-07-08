<?php

require_once('../../data_classes/server-data.php_data_classes-core.php.php');
require_once('../../data_classes/server-data.php_data_classes-session.php.php');

?>
<div class="roomblue">
<div id="hc_confirm_box">

    <img src="<?php echo $path; ?>/web-gallery/v2/images/frank_welcome.png" alt="" align="right" style="margin:10px;" />
<p><b>&iexcl;La compra no se puede realizar con &eacute;xito!</b></p>
<p>Para poder comprar tu acceso al <b><?php echo $shortname; ?> Club</b> debes estar dentro del Hotel.<br><br>M&aacute;s Informaci&oacute;n:<br><i><a href="<?php echo $path; ?>/credits"><?php echo $sitename; ?> Cr&eacute;ditos</i></a>,<br><i><a href="<?php echo $path; ?>/credits/shop/vip">Hazte VIP (Premium) &raquo;</a></i></p>

<p>
<a href="#" class="new-button red-button" onclick="habboclub.closeSubscriptionWindow(); return false;">
<b>Cancelar</b><i></i></a>
<a href="client" class="new-button green-button"><b>Entra a <?php echo $shortname; ?> Hotel &raquo;</b><i></i></a>
</p>

</div>

<div class="clear"></div>