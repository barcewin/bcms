<?php header('content-type: text/html; charset=ISO-8859-1');

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$key = FilterText($_GET['habbletKey']);

if($key == "avatars"){ ?>

<div id="overlay"></div>
<div id="client-ui">

	<div id="content" class="client-content"><div id="avatars" class="client-habblet-container contains-avatars draggable">

<div class="habblet-container ">		
	
	<div style="" id="select-avatar">
	<div class="pick-avatar-container clearfix">
        <div class="title">
            <span style="visibility: visible;" class="habblet-close"></span>
            <h1>Configuraci&oacute;n</h1>
        </div>
		<div id="content">
            <div id="user-info">

                  <img src="http://static.ak.fbcdn.net/pics/q_silhouette.gif">
              <div>
                  <div id="name"><?php echo $myrow['mail']; ?></div>
                  <a style="display: none;" href="/me" id="logout">Volver al hotel</a>
                  <a href="/profile" id="manage-account">Administrar cuenta</a>
              </div>

            </div>

            <div id="first-avatar">
                    <img src="http://habbo.com/habbo-imaging/avatarimage?figure=<?php echo $myrow['look']; ?>&size=b&direction=4&head_direction=4&gesture=sml" width="64" height="110">
                    <div style="padding-top: 20px;" id="first-avatar-info">
                        <div class="first-avatar-name"><?php echo $name; ?></div>
                        <div class="first-avatar-lastonline">&Uacute;ltima vez conectado: <span title="<?php echo date('d.m.Y H:i', $myrow['last_online']); ?>"><?php if($myrow['last_online'] + 60 > time()){ echo"Ahora mismo"; }else{ echo date('d.m.Y H:i', $myrow['last_online']); } ?></span></div>
                        <a style="display: none;" id="first-avatar-play-link" href="/identity/useOrCreateAvatar/8562321?disableFriendLinking=true">
                            <div class="play-button-container">

                                <div class="play-button"><div class="play-text">Ir</div></div>
                                <div class="play-button-end"></div>
                            </div>
                        </a>
                    </div>
            </div>
			
			<hr>
	<p style="margin: 5px 10px;">
	<b>Peticiones de Amistad</b>

	<label>
	<input name="block_newfriends" <?php if($user_row['block_newfriends'] == 0){ ?>checked="checked"<?php } ?> value="true" type="checkbox" disabled="disabled">
		Permitir que me envien peticiones de amistad
	</label>

	<b>Estado</b>

	<label>
	<input name="hide_online" <?php if($user_row['hide_online'] == 0){ ?>checked="checked"<?php } ?> value="true" type="checkbox" disabled="disabled">
		Permitir que otras personas me vean como conectado.
	</label>

	<b>Configuraci&oacute;n de salas</b>

	<label>
	<input name="hide_inroom" <?php if($user_row['hide_inroom'] == 0){ ?>checked="checked"<?php } ?> value="true" type="checkbox" disabled="disabled">
		Tus amigos pueden seguirte
	</label>
	
	</p>
            <div id="link-new-avatar"><a style="float: right;" class="new-button" href="/client"><b>Actualizar</b><i></i></a></div>

            
			
                  </ul>
            </div>
        </div>
    </div>

    <div class="pick-avatar-container-bottom"></div>
  </div>

    
	
	
</div>

<!-- dependencies
<link rel="stylesheet" href="<?php echo $path; ?>/web-gallery/v2/styles/common.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $path; ?>/web-gallery/v2/styles/avatarselection.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $path; ?>/web-gallery/v2/styles/identitysettings.css" type="text/css" />
-->
</div></div>            
</div>
    <div style="display: none;">
<div id="habboCountUpdateTarget">
222 usuarios conectados
</div>
	<script language="JavaScript" type="text/javascript">
		setTimeout(function() {
			HabboCounter.init(600);
		}, 20000);
	</script>

    </div>
    <script type="text/javascript">
        RightClick.init("flash-wrapper", "flash-container");
        if (window.opener && window.opener != window && window.opener.location.href == "/") {
            window.opener.location.replace("/me");
        }
        $(document.body).addClassName("js");
       	HabboClient.startPingListener();
    </script>
<div id="fb-root"><script src="https://connect.facebook.net/es_ES/all.js" async=""></script></div>
<script type="text/javascript">
    (function() {
        var e = document.createElement('script');
        e.async = true;
        e.src = 'https://connect.facebook.net/es_ES/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
</script>


        <iframe name="logframe" src="/bc/logframe?" marginwidth="0" marginheight="0" style="position: absolute; top: 0pt; left: 0pt;" width="0" frameborder="0" height="0" scrolling="no"></iframe>


<iframe name="conversion-tracking" src="/conversion_tracking_frame" marginwidth="0" marginheight="0" style="position: absolute; top: 0pt; left: 0pt;" width="0" frameborder="0" height="0" scrolling="no"></iframe>


<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-448325-18");
pageTracker._trackPageview();
</script>

<script type="text/javascript">
    HabboView.run();
</script>




<?php }elseif($key == "credits"){ require_once('../templates/community_subheader.php'); ?>

<div class="habblet-container ">		
		<div class="cb clearfix orange "><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
		<div class="rounded-container"><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(249, 150, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(247, 108, 16);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(247, 108, 16);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(249, 150, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(247, 108, 16);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div></div><h2 class="title rounded-done">&iexcl;Consigue Lavvo Cr&eacute;ditos!
		<span class="habblet-close"></span></h2><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(247, 108, 16);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(249, 150, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(247, 108, 16);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(249, 150, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(247, 108, 16);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(246, 98, 0);"></div></div></div></div></div></div>


	
<style type="text/css">

.client-habblet-container.contains-credits  {
    width:760px!important;
    height:562px!important;
    left:-760px;
    top:-2px;
}

.paymentmethods-client  {
    height:521px!important;
}

.method {
   float:left !important;
   margin-left:5px !important;
   margin-right:0 !important;
}

.credits-footer .disclaimer, .countries {
  width:90%!important;
}

.paymentmethods-client .moreinfo-section {
  display:none!important;
}

.method-group.online.bestvalue  {
  background-image:url("http://images.habbo.com/c_images/credits_de/de_strike_top_angebot.png");
  background-repeat:no-repeat;
}

.method-group.online #pricepoints span.product-description {
  min-width:10px!important;
}
</style>

<div class="paymentmethods-client">

<style type="text/css">
.method-group.online.bestvalue {
 background-image: url(http://images.habbo.com/c_images/credits_de/de_strike_top_angebot.png);
background-repeat: no-repeat;
}
</style>

<?php require_once('../templates/pages/credits.php'); ?>     

<!-- dependencies
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<link rel="stylesheet" href="<?php echo $path; ?>/web-gallery/v2/styles/newcredits.css" type="text/css" />


<script src="<?php echo $path; ?>/web-gallery/static/js/newcredits.js" type="text/javascript"></script>
    <script type="text/javascript">
        RightClick.init("flash-wrapper", "flash-container");
        if (window.opener && window.opener != window && window.opener.location.href == "/") {
            window.opener.location.replace("/me");
        }
        $(document.body).addClassName("js");
       	HabboClient.startPingListener();
    </script>

<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-448325-18");
pageTracker._trackPageview();
</script>

<script type="text/javascript">
    HabboView.run();
</script>


</body></html>

<?php }elseif($key == "news"){ ?>

<div class="habblet-container ">        
    
    <div id="news-habblet-container">
  <div class="title">
    <div class="habblet-close"></div>
    <div>&iexcl;La mejor informaci&oacute;n, a un clic!</div>
  </div>
  <div class="content-container">
    <div id="news-articles">
      <div id="news-ad">
      </div>
     <ul id="news-articlelist" class="articlelist" style="display: none">
<?php

$i = 0;
$ergebnis = mysql_query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 10;");
while($row = mysql_fetch_assoc($ergebnis)){
$i++;

if(IsEven($i)){
	$even = "even";
} else {
	$even = "odd";
}
?>
<li class="<?php echo $even; ?>">
          <div class="news-title"><?php echo $row['title']; ?></div>
          <div class="news-summary"><?php echo $row['longstory']; ?></div>

          <div class="newsitem-date"><?php echo date('d.m.Y', $row['published']); ?></div>
          <div id="article-body-text-<?php echo $row['id']; ?>" class="article-body-text" style="display: none">
          <?php echo $row['shortstory']; ?><br><br><img src="<?php echo $path; ?>/web-gallery/album1/users_online.PNG"><b><?php echo $row['author']; ?></b><br><br>
          </div>

          <div class="clearfix">
            <a href="#" class="article-toggle" id="article-title-<?php echo $row['id']; ?>">Leer m&aacute;s</a>
          </div>
        </li>
<?php } ?>
      </ul>
    </div>
  </div>
  <div class="news-footer" id="news-footer" style="font-size:9px;" align="center"></div>
</div>
<script type="text/javascript">    
    L10N.put("news.promo.readmore", "Leer m&aacute;s").put("news.promo.close", "Cerrar art&iacute;culo");
    News.init(true);s

</script>
    
    
</div>

<!-- dependencies
<link rel="stylesheet" href="<?php echo $path; ?>/web-gallery/v2/styles/news.css" type="text/css" />
<script src="<?php echo $path; ?>/web-gallery/static/js/news.js" type="text/javascript"></script>
-->
<?php } ?>