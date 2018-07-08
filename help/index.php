<?php
/*/==============================\ \
| | barcewinCMS
| | Powered by barcewin
| |	Creando nuevas formas de jugar
| | Diseño Habbo
\ \==============================*/
define('ID_RICHIESTO', FALSE);
require_once "../data_classes/server-data.php_data_classes-core.php.php";
?>
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
<div class="content content_green"><div class="green_box_top"><div class="box box_top"></div></div>      <h2 id="search_box">Haz aqu&iacute; tu consulta</h2>
      <form id="suggest_form" action="#">
        <input id="suggestions_query" name="suggestions_query" type="text" /><input class="button search primary" id="suggestion_submit" name="commit" type="submit" value="Buscar" />
        <input type="hidden" name="page" id="page" value="1"/>
        <input type="hidden" name="per_page" id="per_page" value="3"/>
      </form>

        <div id="topic_search_loading"></div>
<div id="topic_search" style="display:none;">
  <div class="frame" style="margin-top: 15px; padding-bottom: 20px;">
    <div id="topic_search_result"></div>
    
<h2 style="margin-top: 5px; padding-top: 12px;">Non hai trovato quello che cercavi?</h2>



<div class="deflect tickets" id="ticket-deflect">
  <h3>Entra in contatto</h3>
  <ul><li><a href="/anonymous_requests/new">Compila il modulo di richiesta</a></li></ul>
</div>

    <div style="clear:both;"></div>
  </div>
</div>

<div class="green_box_bottom"><div class="box box_bottom"></div></div></div><div class="box_bottom_clear">&nbsp;</div>  </div>
    <script type="text/javascript">
//<![CDATA[
zd.jsInitializers.push(["home/_home_page_search_box",[{"autocomplete":true}]]);
//]]>
</script>



  <div class='forum_tabs'>
<div class="content content_grey"><div class="grey_box_top"><div class="box box_top"></div></div>      
  <p class="forum-nav">
    Informaci&oacute;n general | <a href="#overview" id="forum_nav_overview" url="/help/">Recientes</a>
  </p>

      
      <div id="content_entries">
        <div class="frame columns">
      <div >
          
        
  <div class="category" id="category_none" >


    <div class="column" id="forum_217173" data-forum_id="217173" data-forum_path="/forums/217173-News">
  <h3 class="clearfix">
    <a href="/help/entries/index.php">
      <span>Importante Ahora</span>
      <span class='sub-counter'><b>(<?php 
$query = mysql_query("SELECT COUNT(*) AS news FROM help_topics") or die(mysql_error()); 
$data = mysql_fetch_assoc($query); 
echo $data['news']; 
?>)</b></span>
      <span class="follow_link">»</span>
    </a>
	
  </h3>
<?php
$news1_5 = mysql_query("SELECT * FROM help_topics ORDER BY id DESC LIMIT 3") or die(mysql_error());
 $i = 0; while($news = mysql_fetch_assoc($news1_5)){ $i++; ?>
<li class="articles">
<div class="title"><a href="<?php echo $site.'/articles/'.$news['id']; ?>"><?php echo $news['title']; ?></a></div>
<?php } ?>
  <ul>
        <li class="fade_truncation_outer articles ">
          <div class="fade_truncation_inner"></div>
          
        </li>
  </ul>
</div>




    <div style="clear:both; height:0px;">&nbsp;</div>
  </div>


      </div>
      <div >
            <div class="category-header">
    <h2><a href="/help/faq.php">Preguntas Frecuentes<span class="follow_link">»</span></a></h2>
  </div>

        
  <div class="category" id="category_2339" data-category_path="/categories/2339-Domande-frequenti">


    <div class="column" id="forum_217223" data-forum_id="217223" data-forum_path="/forums/217223-Habbo-Crediti">
  <h3 class="clearfix">
    <a href="#">
      <span> Cr&eacute;ditos</span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
       
  </ul>
</div>
<div class="column" id="forum_217240" data-forum_id="217240" data-forum_path="/forums/217240-Account-e-Ban">
  <h3 class="clearfix">
    <a href="#">
      <span>Guía para Padres/Madres</span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
       
  </ul>
</div>
<div class="column" id="forum_217369" data-forum_id="217369" data-forum_path="/forums/217369-Sicurezza-Account-e-Personale-">
  <h3 class="clearfix">
    <a href="#">
      <span>Cuenta <?php echo $nomesito; ?> y Baneos/Expulsiones</span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
       
  </ul>
</div>
<div class="column" id="forum_219200" data-forum_id="219200" data-forum_path="/forums/219200-Informazioni-per-genitori">
  <h3 class="clearfix">
    <a href="#">
      <span>Seguridad en <?php echo $nomesito; ?></span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
        
  </ul>
</div>
<div class="column" id="forum_219826" data-forum_id="219826" data-forum_path="/forums/219826-Habbo-Furni-e-Giochi">
  <h3 class="clearfix">
    <a href="#">
      <span>Furnis/Muebles y Juegos</span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
       
  <ul>
       
  </ul>
</div>
<div class="column" id="forum_257950" data-forum_id="257950" data-forum_path="/forums/257950-Informazioni-generali-su-Habbo-Hotel-">
  <h3 class="clearfix">
    <a href="#">
      <span>Controlando tu <?php echo $nomesito; ?></span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
       
  </ul>
</div>
<div class="column" id="forum_21511951" data-forum_id="21511951" data-forum_path="/forums/21511951-Competizioni">
  <h3 class="clearfix">
    <a href="#">
      <span>Competiciones</span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
       
  </ul>
</div>
<div class="column" id="forum_22876368" data-forum_id="22876368" data-forum_path="/forums/22876368-Termini-e-Condizioni-d-uso">
  <h3 class="clearfix">
    <a href="/forums/22876368-Termini-e-Condizioni-d-uso">
      <span>Términos y Condiciones del Servicio</span>
      <span class='sub-counter'>(0)</span>
      <span class="follow_link">»</span>
    </a>

  </h3>

  <ul>
        
  </ul>
</div>




    <div style="clear:both; height:0px;">&nbsp;</div>
  </div>


      </div>

</div>

      </div>
      
<div class="grey_box_bottom"><div class="box box_bottom"></div></div></div><div class="box_bottom_clear">&nbsp;</div> 



 </div>
 
 </div>
 </div>
 <?php include './sidebar.php'; ?>
 
</body>
</html>
