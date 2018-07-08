<link href="https://p6.zdassets.com/assets/application/global-0a70adca25728d65e168340373b2ee39.css" media="all" rel="stylesheet" />
<link href="https://p6.zdassets.com/assets/application/end_user-2aa5e1d130b8b9b7de027df856e42691.css" media="all" rel="stylesheet" />
<link href="https://p6.zdassets.com/assets/application/agent-b927ae1727d83aed65e1275c13a75d65.css" media="all" rel="stylesheet" />
<link href="https://p6.zdassets.com/assets/application/admin-1e8c9ce203a12b7e2f2a5294ff4153a8.css" media="all" rel="stylesheet" />
<link href="https://p6.zdassets.com/assets/print-b9c9930d3290ee9cb0a09bd4426bd8b5.css" media="print" rel="stylesheet" />
<link id='generated_styles' rel='stylesheet' type='text/css' href='https://help.habbo.it/generated/stylesheets/branding/444/44438/1385494930.css' />
</head>

<body class="home home-index">
  <ul id='banners'>
  <script type='text/html' id='banner-item-template' data-template-name='banner-item'>
    <li>
      <span class='icon'>&nbsp; &nbsp; &nbsp; </span>
      <span class='content'>{{ text }}</span>
      <span class='ignore'>(<a href="#">Ignorar</a>)</span>
      <span class='reload'>(<a href="">Recargar</a>)</span>
    </li>
  </script>
</ul>

  <div id="page">
<div id="top">
      <div id="header">  
<?PHP
if(!session_is_registered(username)){

	  ?>
        <div id="top-right"><a href="../index.php?return_to=/help/index.php">Iniciar sesi&oacute;n</a></div>
		
<?php } else { ?>

    <div id="top-right"><?php echo $name; ?> | <a href="../me.php">Regresar al Hotel</a></div>
    
   <?PHP
}
    ?>
        <div id="header_container">
    <table id="table_header"><tr>
      <td><a href="../../index.php" target="_blank" title=""><img alt="" id="logo" src="../../logo.png" /></a>&nbsp;</td>
      <td><img alt="" id="logo-delimiter" src="https://p6.zdassets.com/images/logo-delimiter.png?1354147899" />&nbsp;</td>
      <td><a href="/help/"><?php echo $sitename; ?> Atenci&oacute;n al Usuario/a</a></td>
    </tr></table>
    
</div>

      </div>


<?PHP
if(!session_is_registered(username)){
	  ?>
  <div id="top-menu-background">
        <div id="top-menu">
          <ul id="green" style="width: 100%;">
            <li class="main clazz tab_home"><a href="/help/index.php" class="tab">Inicio</a></li>
              <li class="main clazz tab_new"><a href="/help/index.php" class="tab">Haz aqu&iacute; tu consulta</a></li>
			   	
       
          </ul>
        </div>
      </div>
    </div>
    <?php
	
} else {
?>
      <div id="top-menu-background">
        <div id="top-menu">
          <ul id="green" style="width: 100%;">
            <li class="main clazz tab_home"><a href="/help/index.php" class="tab">Inicio</a></li>
              <li class="main clazz tab_new"><a href="/help/index.php" class="tab">Haz aqu&iacute; tu consulta</a></li>
			  <li class="main clazz tab_new"><a href="/help/requestnew.php" class="tab">Enviar una solicitud</a></li>	
       		  <li class="main clazz tab_new"><a href="/help/requests.php" class="tab">Revisar solicitudes existentes</a></li>	
          </ul>
        </div>
      </div>
    </div>
    
    
   <?PHP
}
    ?>
<embed src="../plugin/pop.mp3" width="0" height="0">