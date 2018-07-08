<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$id = FilterText($_POST['accountId']);
$sql = mysql_query("SELECT * FROM users WHERE id = '".$id."' LIMIT 1");
$row = mysql_fetch_assoc($sql); 

?>
<p>
&iquest;Est&aacute;s seguro que deseas agregar a <b><?php echo $row['username']; ?></b> a tu lista de amigos? 
</p>

<p>
<a href="#" class="new-button done"><b>Cancelar</b><i></i></a>
<a href="#" class="new-button add-continue"><b>Continuar</b><i></i></a>
</p>