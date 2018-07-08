<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$dolares = FilterText($myrow['dolares']); 
$voucher = FilterText($_POST['voucherCode']); 

$check = mysql_query("SELECT value FROM credit_vouchers WHERE code = '" . $voucher . "' LIMIT 1") or die(mysql_error()); 
$valid = mysql_num_rows($check); 

if($valid > 0){ 
    $tmp = mysql_fetch_assoc($check); 
    $amount = $tmp[value]; 
    $resultcode = "green";  
    $result = "<div class='rounded rounded-green'>Usted tiene ".$dolares." Dólares!</div>";
    $dolares = $dolares + $amount; 
    mysql_query("UPDATE users SET dolares = '".$dolares."' WHERE username = '" . FilterText($name) . "' LIMIT 1") or die(mysql_error()); 
    mysql_query("DELETE FROM credit_vouchers WHERE code = '" . $voucher . "' LIMIT 1") or die(mysql_error()); 
    $result = "<div class='rounded rounded-green'>Acabas de recibir " . $amount . " Dólares.</div>"; 

    $resultcode = "green"; 
    $result = "<div class='rounded rounded-green'>&iexcl;Has recibido ".$amount." Dólares!</div>"; 
} else { 
    $resultcode = "red"; 
    $result = "<div class='rounded rounded-red'>El c&oacute;digo Puk introducido es incorrecto. Int&eacute;ntelo de nuevo.</div></div>"; 
} 

?>

<div class="redeem-result">
<div class="rounded-container">

<form method="post" action="credits" id="voucher-form">
<div class="redeem-redeeming"> 
<div><input type="text" name="voucherCode" value="" id="purse-habblet-redeemcode-string" class="redeemcode" /></div>
<div class="redeem-redeeming-button">
<a href="#" id="purse-redeemcode-button" class="new-button green-button redeem-submit"d="purse-redeemcode-button" class="new-button purse-icon">
<b><span></span>Canjear</b><i></i></a></div> 
</form> <div style="height: 15px;"></div><br><br>
	<?php echo $result; ?>
<br>

<script type="text/javascript">
new PurseHabblet();
</script>