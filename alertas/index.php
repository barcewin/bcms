<?php 

require_once('../data_classes/server-data.php_data_classes-core.php.php');

if($_GET['do'] == "RemoveFeedItem" && is_numeric($_GET['key'])){
    mysql_query("DELETE FROM cms_alerts WHERE userid = '".$my_id."' AND id = '".FilterText($_GET['key'])."' ORDER BY id ASC LIMIT 1");
   }

$pagename = $name;
$pageid = "1";
$tab = "1";

$mensajes = mysql_query("SELECT COUNT(*) FROM cms_minimail WHERE receiver_id = '".$my_id."'") or $mensajes = 0;
header("X-JSON: {\"totalmensajes\":".$mensajes."}");


include ('./lib/standard/nav/header.php');

?>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $shortname; ?> - No soy un robot...</title>
		<link rel="stylesheet" href="<?php echo $cms_url; ?>/alertas/css/habalert.css" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Ubuntu:400,500,700" />
	</head>

	<body bgcolor="#15507c">
		
		<a href="#" id="openhabAlert" class="habalert-controls"><font color="white">Crear solicitud</font></a>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="alertas/js/habAlert.js"></script>
		<script>
		$('#openhabAlert').on('click', function() {
			$.habAlert({
				title: 'Mensaje Staff',
				image: 'alertas/img/qmarks.png',
				leadTitle: 'Soporte',
				body: '<font color="white"><p>Hola <strong><?php echo $name; ?></strong>, con este sistema comprobamos que eres t&uacute; quien realiza este proceso, da clic en continuar para hacer tu solicitud.</p></font>',
				controls: {
					links: [
						{href: '#close', text: 'Cancelar'}
					],
					buttons: [
						{href: '<?php echo $cms_url; ?>/help/requestnew.php', text: 'Continuar'}
					]
				}
			});
		});
		</script>
	</body>
</html>