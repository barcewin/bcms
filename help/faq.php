<?php
/*/==============================\ \
| | barcewinCMS
| | Powered by barcewin
| |	Creando nuevas formas de jugar
| | Diseño Habbo
\ \==============================*/
define('ID_RICHIESTO', FALSE);
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

  <div id="flash">
</div>



  <div id="flash_messages">
    



<script type="text/javascript">
</script>

  </div>

  

  <div id="contentwrapper">
    <div id="contentcolumn">
      




    <div id="solution_suggestion">
<div class="content content_green"><div class="box box_top"></div>      <h2 id="search_box">Informaci&oacute;n</h2>
      <form id="suggest_form" action="#">
       Preguntas Frecuentes
      </form>




  <div class='forum_tabs'>
<div class="content content_grey"><div class="grey_box_top"><div class="box box_top"></div></div>   
  <p class="forum-nav">

  </p>

      
      <div id="content_entries">
        <div class="frame columns">
      <div >
          
        

  <div class="category" id="category_none" >
  <table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' width='20%'><b>Pregunta</b><br></td>
  <td class='tablesubheader' width='80%'><b>Respuesta</b><br></td>
 </tr>
<?php
$gruppiq = mysql_query("SELECT * FROM faq ORDER BY id ASC");
			while($row = mysql_fetch_array($gruppiq)){
	echo '<tr>
  <td class="tablerow1"><br>'.$row['question'].'<br></td>
  <td class="tablerow2"><br>'.$row['answer'].'<br></td>
</tr>';
}
?>

    <div style="clear:both; height:0px;">&nbsp;</div>
  </div>


      </div>
      <div >
          
  




    <div style="clear:both; height:0px;">&nbsp;</div>
  </div>


      </div>

</div>

      </div>
<div class="box box_bottom"></div></div><div class="box_bottom_clear">&nbsp;</div>  </div>

<script type="text/javascript">
//<![CDATA[
zd.jsInitializers.push(["home/index",[]]);
//]]>
</script>


    </div>
  </div>

  <div id="sidebar">
  </div>

</div>


  </div>

  <div id="footer">
  

</div>

<!-- Render any mouseover tips on the page -->

<script type="text/javascript">
//<![CDATA[
  if(!Zendesk) var Zendesk = {};
  Zendesk.tab = "home";

//]]>
</script>
<script src="https://assets.zendesk.com/assets/auto_included-614c99b606b42b56258bbac23b537be3.js" type="text/javascript"></script>
  <script src="https://assets.zendesk.com/assets/zd_tickets_table_node-46252e9afb1acc292abdbe799111d149.js" type="text/javascript"></script>
  <script src="https://assets.zendesk.com/assets/zd_ticket_viewing_status_node-6a5ed52365ae5d8f2af51acd56d5e50e.js" type="text/javascript"></script>

<script type="text/javascript">
//<![CDATA[
  $z.initializeModules(zd.jsInitializers);

//]]>
</script>
  <script type="text/javascript" charset="utf-8">
$('footer').innerHTML='<p>© 2010 Sulake Corporation Oy. HABBO is a registered trademark of Sulake Corporation Oy in the European Union, the USA, Japan, the People\'s Republic of China and various other jurisdictions. All rights reserved.</p><p><a href="http://www.zendesk.com">Customer support</a> software by Zendesk</p>';
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', "UA-448325-34"]);
  _gaq.push(['_setDomainName', "none"]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" charset="utf-8">
$j(document).ready(function() {
$j("a[href*='/logout']").html("Salir");
});
</script>

    <script type="text/javascript" charset="utf-8">
      $j(document).ready(function () {
        var cacheBuster = currentUser.isAnonymous ? currentUser.localeVersion : currentUser.version;
        $j.ajax({
          url: '/widgets/async.json?user_id=' + currentUser.id + '&v=' + cacheBuster,
          data: {"controller_name":"home","action_name":"index","action_method":"get"},
          success: Widget.asyncInsertion
        });
      });
    </script>

  

<script type="text/javascript">
//<![CDATA[
    
    jQuery(document).ready(function () {
          Zendesk.Alerts.showPasswordExpiration();

    });

//]]>
</script></body>
</html>