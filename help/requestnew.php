<?php
//TProgram
define('ID_RICHIESTO', TRUE);
require_once "../data_classes/server-data.php_data_classes-core.php.php";
if(!session_is_registered(username)){

    header('Location: ../index.php');
    exit;
}

if(isset($_POST['registra']))
{
    
    $author = (isset($_POST['author'])) ? trim($_POST['author']) : ''; 
	$subject = (isset($_POST['subject'])) ? trim($_POST['subject']) : '';
	$description = (isset($_POST['description'])) ? trim($_POST['description']) : '';
	$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
	
	  if (!get_magic_quotes_gpc()) {
        $author = addslashes($author);
        $subject = addslashes($subject);
        $description = addslashes($description);
		$username = addslashes($username);
		
    }
	
	$query = mysql_query("INSERT INTO help_richieste (id, autore, richiesta, descrizione, nomeutente, utente, attiva, categoria) VALUES
(NULL, '".$author."', '".$subject."', '".$description."', '".$username."', '".$nomeuser."','1', 'staff')");
 echo '<font color="#FF0000"><b><h3>Has enviado tu solicitud con exito, tan pronto podamos te responderemos!</h3></b></font>';
echo '<meta http-equiv="Refresh" content="0.5; index.php" />';
    
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

  <!-- REQUEST FORM -->
<form id="ticketform" method="post" name="ticketform">
    <h2>Enviar una solicitud</h2>
	
    <div id="ticketfields">     
      <div id="end-user-form" style="width:98%;">
        <div id="ticket-field-friends">

<div id="input_author" style="margin-top:10px;">
<span style="font-size:16px;font-weight:bold;">Hola <?php echo $sitename; ?>, soy <super>*</super></span>
<p>Por favor, dinos qui&eacute;n eres</p>
<select name="author" onfocus="this.style.boxShadow='0px 0px 5px #0099FF';this.style.backgroundImage='url(/inc/images/input_background.png)';" onblur="this.style.boxShadow='';this.style.backgroundImage='url()';">
<option value="">-</option>
<option value="player">un usuario de <?php echo $sitename; ?></option>
<option value="parent">el padre/madre de un/a usuario/a</option>
<option value="neither">ninguna de las anteriores</option></select>
</div>

<div id="input_subject" style="margin-top:15px;">
<span style="font-size:16px;font-weight:bold;">Y quiero contactarles sobre <super>*</super></span>
<p>Por favor, elige de la lista el motivo de tu consulta. Selecciona la opci&oacute;n correcta para que podamos contestarte m&aacute;s r&aacute;pido.</p>
<select id="subject_select" name="subject" onfocus="this.style.boxShadow='0px 0px 5px #0099FF';this.style.backgroundImage='url(/inc/images/input_background.png)';" onblur="this.style.boxShadow='';this.style.backgroundImage='url()';" onchange="checkMoreInfos();">
<option value="">-</option>
<option value="creditos">un problema con la compra de Habbo Créditos</option>
<option value="baneo">Me han baneado/Mi hijo/a ha sido expulsado/a</option>
<option value="cuenta">Alguien ha accedido a mi cuenta/la cuenta de mi hijo/a</option>
<option value="bug">Un problema técnico con <?php echo $sitename; ?></option>
<option value="idea">Quiero compartir una idea con <?php echo $sitename; ?></option>
<option value="sugerencia">Una propuesta de marketing/negocio/comercial u asuntos relacionados</option>
<option value="otro">Ninguna de las anteriores</option></select>
</div>

<div id="input_description" style="margin-top:15px;">
<span style="font-size:16px;font-weight:bold;">Descripción <super>*</super></span>
<p>Por favor, explícanos el motivo de tu correo (si tu consulta es por un baneo indica a continuación el año de finalización de tu expulsión).<br>Un miembro del equipo de Atención al Usuario te contestará lo antes posible. Recuerda que, antes de escribirnos deberías de revisar nuestras <a href="faq.php">FAQs</a>. La mayoría de los asuntos más comunes en <?php echo $sitename; ?> se responden allí.</p>
<p>Si quieres informarnos sobre un comportamiento contra la Manera Habbo que ha ocurrido dentro del Hotel (insultos, acoso, contenido sexual etc.) necesitas enviar una Alerta dentro del Hotel en el momento en que ocurra– Atención al Usuario no puede ayudarte. Si no sabes cómo enviar una Alerta, por favor, revisa nuestra Guía <a href="">aquí</a>.
</p>
<textarea cols="68" name="description" rows="6" onfocus="this.style.boxShadow='rgba(0, 0, 0, 0.07) 0px 40px 152px inset, #09F 0px 0px 5px';" onblur="this.style.boxShadow='';"></textarea>
</div>

<div id="input_username" style="margin-top:15px;">
<span style="font-size:16px;font-weight:bold;">Mi nombre <?php echo $sitename; ?> es… <super>*</super></span>
<p>Si tienes una cuenta <?php echo $sitename; ?>, por favor, escribe el nombre de tu personaje. Si eres padre/madre de un usuario, introduce su <?php echo $sitename; ?> Nombre.</p>
<input name="username" size="30" type="text" onfocus="this.style.boxShadow='0px 0px 5px #0099FF';this.style.backgroundImage='url(/inc/images/input_background.png)';" onblur="this.style.boxShadow='';this.style.backgroundImage='url()';" value="">
</div>

<div id="more_info_box" style="display:none;margin-top:15px;"><span id="more_info_title" style="font-size:16px;font-weight:bold;"></span>
<p id="more_info_description"></p>
<input id="more_info_input" name="more_info" size="30" type="text" onfocus="this.style.boxShadow='0px 0px 5px #0099FF';this.style.backgroundImage='url(/inc/images/input_background.png)';" onblur="this.style.boxShadow='';this.style.backgroundImage='url()';" value=""></div>
<script> checkMoreInfos(); </script>

<div class="action">
	<input class="button primary" type="submit" id="submit-button" name="registra" value="Enviar">
</div>
</div>

      </div>
    </div>
</form>
<div class="grey_box_bottom"><div class="box box_bottom"></div></div></div><div class="box_bottom_clear">&nbsp;</div>
      </div>
    </div>
<div id="sidebar">
        <div id="widget_fixed" class="draggable"><div><div class="blue_box_top"></div><div class="side-box-content"><h3>Enviar una solicitud de asistencia</h3>    <p>Los campos marcados con un asterisco (*) son obligatorios.</p><p>Recibirá una notificación cuando nuestro personal responda a su consulta.</p>
<div style="clear:left; height:8px;"></div></div><div class="blue_box_bottom">&nbsp;</div></div></div>
    </div>
</div>


  </div>
</body>
</html>
