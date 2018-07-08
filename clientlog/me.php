<?php 
require_once('./data_classes/server-data.php_data_classes-core.php.php');
require_once('./data_classes/server-data.php_data_classes-session.php.php');

if($_GET['do'] == "RemoveFeedItem" && is_numeric($_GET['key'])){
    mysql_query("DELETE FROM cms_alerts WHERE userid = '".$my_id."' AND id = '".FilterText($_GET['key'])."' ORDER BY id ASC LIMIT 1");
   }

$pagename = $name;
$pageid = "1";



include('templates/community_subheader.php');
include('templates/community_header.php');


$get_flashclient = mysql_query("SELECT * FROM cms_settings WHERE variable = 'cms_flashclient' AND value = '1'");

?>

<link rel="stylesheet" href="<?php echo $path; ?>/web-gallery/static/styles/lightweightmepage.css" type="text/css" />


<script src="<?php echo $path; ?>/web-gallery/static/js/lightweightmepage.js" type="text/javascript"></script>
<script src="DWConfiguration/ActiveContent/IncludeFiles/AC_RunActiveContent.js" type="text/javascript"></script>


<div id="container">
	<div id="content" width="755px">
		<table>
			<tr>
				<td>
					<div class="cbb clearfix green" width="755px">
						<table width="755px">
							<tr>
								<td width="10px"></td>
								<td align="center" width="728px">

								
<br />

								</td>
								<td width="17px"></td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>

<div id="column1" class="column">



<div id="container">

<div id="content" style="position: relative" class="clearfix">



<div id="content" style="position: relative" class="clearfix">

    <div id="wide-personal-info">





    <div id="habbo-plate">



          <a href="<?php echo $path; ?>/home/<?php echo $rawname; ?>">



            <img alt="Usuario" src="http://www.habbo.com.tr/habbo-imaging/avatarimage?figure=<?php echo $myrow['look']; ?>&direction=3&head_direction=3&gesture=sml&action=&size=l"/>



        </a>



    </div>





    <div id="name-box" class="info-box">



        <div class="label">Usuario Javvo:</div>



        <div class="content"><?php echo $name; ?></div>



    </div>



    <div id="motto-box" class="info-box">



        <div class="label">Misión:</div>



        <div class="content"><?php echo HoloText($myrow['motto']); ?></div>



    </div>



    <div id="last-logged-in-box" class="info-box">



        <div class="label">Tu última conexión:</div>



        <div class="content"><?php echo $myrow['last_online']; echo""; ?> </div>



    </div>







<div class="enter-hotel-btn">

    <div class="open enter-btn">
			
            <a href="<?php echo $cms_url; ?>/client" target="_blank">Entra al Hotel<i></i></a>

        <b></b>



    </div>

</div>





</div>









<div id="promo-box">

<div id="promo-bullets"></div>





	<div class="promo-container" style="background-image: url(http://habbocorp.org/ts/promo6.png)">



        <div class="promo-content">



            <div class="title">¡HabboCorp Online nuevamente!</div>



            <div class="body"><p>¡La Comunidad de HabboCorp te recibe con los brazos abiertos!</p>
<p>Nuestra comunidad se complace en recibirte una vez más, esperamos que tu estadía en el Hotel sea grata. ¡Enterate de todas las Novedades de HabboCorp!<span style="text-decoration: underline; font-size: small;"><em><strong><a href="http://adf.ly/1498226/habbocorp><span style="color: #ffffff;"> Entra al Hotel</span></a></strong></em></span></p></div>



        </div>





        <a href="https://facebook.com/HabboCorp" target="_blank" class="facebook-link" onclick="recordOutboundLink('Promo','HabboCorp Facebook Button');"></a>

	<a href="http://twitter.com/info_hcorp" target="_blank" class="twitter-link" onclick="recordOutboundLink('Promo','HabboCorp Twitter Button');"></a>

<div class="enter-hotel-btn">

    <div class="open enter-btn">
           <a href="http://adf.ly/1498226/habbocorp" class="new-button green-button" target="client" onclick="HabboClient.openOrFocus(this); return false;">Entra al Hotel<i></i></a>

        <b></b>

    </div>



</div>

</div>









</div>



<script type="text/javascript">



    document.observe("dom:loaded", function() { PromoSlideShow.init(); });



</script>





<div id="column1" class="column">
<div class="habblet-container ">
<script type="text/javascript"> 
	HabboView.add(function() {
		L10N.put("personal_info.motto_editor.spamming", "&iexcl;Hey, no al spam!");
		PersonalInfo.init("");
	});
</script>

</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>


<?php 
// #########################################################################
// Noticiones
// #########################################################################

$hotcampaigns = mysql_query("SELECT * FROM cms_hotcampaigns ORDER BY id DESC LIMIT 10") or die(mysql_error()); 
if(mysql_num_rows($hotcampaigns) > 0){ ?>

<div class="habblet-container ">        
<div class="cbb clearfix orange ">
<h2 class="title">Noticiones</h2>
<div id="hotcampaigns-habblet-list-container">

<?php while($row = mysql_fetch_assoc($hotcampaigns)){ ?>
<ul id="hotcampaigns-habblet-list">

<li class="even">
	<div class="hotcampaign-container">
                <a href="<?php echo $row['url']; ?>"><img src="<?php echo $row['image_url']; ?>" align="left" alt="" /></a>
                <h3><?php echo $row['caption']; ?></h3>
                <p><?php echo $row['descr']; ?></p>
		<p class="link"><a href="<?php echo $row['url']; ?>">Ir &raquo;</a></p>
	</div>
</li>

</ul>

<?php  } ?>
</div>
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template)) { Rounder.init(); }</script>

<?php }
// #########################################################################
// Habbos Suchen
// #########################################################################
?>
<div class='cbb clearfix red '>
	
<h2 class='title'>Facebook Oficial</h2>
<center><iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FHCorpORG&amp;width=430&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=true&amp;border_color&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:430px; height:300px;" allowTransparency="true"></iframe></center>
</div>

<div class="habblet-container ">		
<div class="cbb clearfix default ">
<div class="box-tabs-container clearfix">
<h2>Buscador</h2>

<ul class="box-tabs">
<li id="tab-0-4-1" class="selected"><a href="#">Buscar</a><span class="tab-spacer"></span></li>
</ul>
</div>

<div id="tab-0-4-1-content">
<div class="habblet-content-info">
<a name="habbo-search">Busca otros usuarios de HabboCorp:</a>
</div>
<div id="habbo-search-error-container" style="display: none;"><div id="habbo-search-error" class="rounded rounded-red"></div></div>
<br clear="all"/>
<div id="avatar-habblet-list-search">
<input type="text" id="avatar-habblet-search-string"/>

<a href="#" id="avatar-habblet-search-button" class="new-button"><b>Buscar</b><i></i></a>
</div>

<br clear="all"/>

<div id="avatar-habblet-content">
<div id="avatar-habblet-list-container" class="habblet-list-container">
      
<ul class="habblet-list"></ul>

</div>

<script type="text/javascript">
    L10N.put("habblet.search.error.search_string_too_long", "La palabra es demasiado larga. El n&uacute;mero m&aacute;ximo de caracteres permitidos es de 30");
    L10N.put("habblet.search.error.search_string_too_short", "La palabra es demasiado corta. Se necesita un m&iacute;nimo de 2 caracteres");
    L10N.put("habblet.search.add_friend.title", "A&ntilde;adir a la Lista de Amigos");
	new HabboSearchHabblet(2, 30);
</script>

</div>

<script type="text/javascript">
    Rounder.addCorners($("habbo-search-error"), 8, 8);
</script>

</div>

</div>

</div>

<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
</div>

<?php
// #########################################################################
// News
// #########################################################################

require_once('./data_classes/server-data.php_data_classes-news.php.php');
?>
				
<div class="cbb clearfix green"> 
<h2 class="title">RadioFourLife</h2>
<center><embed src="http://www.xatech.com/web_gear/flash/Radio.swf" width="350" height="100" flashvars="file=http://192.95.18.236:9968"></embed><br /></a></center>
</div> 





                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>




</div>

<script type="text/javascript">
	HabboView.add(LoginFormUI.init);
</script>

<?php require_once('./templates/community_footer.php'); ?>
