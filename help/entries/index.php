<?php
/*/==============================\ \
| | barcewinCMS
| | Powered by barcewin
| |	Creando nuevas formas de jugar
\ \==============================*/
define('ID_RICHIESTO', FALSE);
require_once "../../data_classes/server-data.php_data_classes-core.php.php";
?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>
     Atenci&oacute;n al Usuario/a
  </title>

	  	<?php include("../header.php"); ?>

    

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



<div class="forum_tabs">
    <div class="content content_grey"><div class="grey_box_top"><div class="box box_top"></div></div>
          <div class="content-top-right top add-button">
    <p class="button-item">
      
    </p>
  </div>

  <p class="forum-nav">
  Información general | <a href="#recientes" id="forum_nav_recent" url="/help/entries/index.php">Recientes</a>
  </p>  

      <div id="content_entries">
        <?php
$news1_5 = mysql_query("SELECT * FROM help_topics ORDER BY id DESC LIMIT 3") or die(mysql_error());
 $i = 0; while($news = mysql_fetch_assoc($news1_5)){ $i++; ?>
<div class="frame paginates_with_more" id="search-result">

      <div class="item ">
	  
<div class="icon"> 
<!-- only highlight topics in forum overviews -->
    <img src="http://help.habbo.es/images/types/article.png" title="Artículo"/>
      <div class="vote"><span class="count"></span></div>
</div>

<div class="item-info" id ="entry-40874348">
  <h1 id="entry_40874348_subj" class="fade_truncation_outer">
    <div class="fade_truncation_inner"></div>
    <span class="highlight">
      <a href="<?php echo $cms_url; ?>/articles/<?php echo $news['id']; ?>" title="<?php echo $news['title']; ?>"><?php echo $news['title']; ?></a>
    </span>
  </h1>

  <p class="info data">
      Publico</p>

</div>


  </div>


</div>
<?php } ?>
      </div>
<div class="grey_box_bottom"><div class="box box_bottom"></div></div></div><div class="box_bottom_clear">&nbsp;</div>  </div>

<script type="text/javascript">
//<![CDATA[
zd.jsInitializers.push(["forums/show",[{"autocomplete":true}]]);
//]]>
</script>
 
 </div>
 </div>
 <?php include './sidebar.php'; ?>
 
</body>
</html>
