<?php
//TProgram
define('ID_RICHIESTO', TRUE);
require_once "../data_classes/server-data.php_data_classes-core.php.php";
if(!session_is_registered(username)){

    header('Location: ../index.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>
     Atenci&oacute;n al Usuario/a 
  </title>
	  	<?php include("header.php"); ?>

    

<div id="container" class="clearfix">
    <div id="contentwrapper">
      <div id="contentcolumn">
      
<div class="content content_grey"><div class="grey_box_top"><div class="box box_top"></div></div>
<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' width='10%' align='center'><b>ID</b></td>
  <td class='tablesubheader' width='20%'><b>Pregunta</b></td>
  <td class='tablesubheader' width='70%' align='center'><b>Descripci&oacute;n</b></td>
 </tr>
<?php
$gruppiq = mysql_query("SELECT * FROM help_richieste WHERE attiva = '1' AND utente = '".$nomeuser."' ORDER BY id ASC");
			while($row = mysql_fetch_array($gruppiq)){
	echo '<tr>
  <td class="tablerow1" align="center">'.$row['id'].'</td>
  <td class="tablerow2" align="center"><strong>'.$row['richiesta'].'</strong></td>
  <td class="tablerow2" align="center">'.$row['descrizione'].'</td>
 															
</tr>';
}
?>
 
 </table>
<div class="grey_box_bottom"><div class="box box_bottom"></div></div></div><div class="box_bottom_clear">&nbsp;</div>
      </div>
    </div>

    <div id="sidebar">
        <div id="widget_fixed" class="draggable"><div><div class="blue_box_top"></div><div class="side-box-content"><h3>Est&aacute; viendo una lista de solicitudes abiertas</h3>
		<div style="clear:left; height:8px;"></div></div><div class="blue_box_bottom">&nbsp;</div></div></div>
    </div>
</div>

</body>
</html>
