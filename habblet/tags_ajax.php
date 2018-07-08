<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$key = FilterText($_GET['key']);
$tag = FilterText($_POST['tagName']);

$tmp = mysql_query("SELECT * FROM user_tags WHERE user_id = '".$my_id."' LIMIT 20") or die(mysql_error());
$tag_num = mysql_num_rows($tmp);

$randomq[] = "&iquest;Qui&eacute;n es tu actor favorito?";
$randomq[] = "&iquest;Prefieres deporte o siesta?";
$randomq[] = "&iquest;Tienes un sobrenombre?";
$randomq[] = "&iquest;Cu&aacute;l es tu canci&oacute;n favorita?";
$randomq[] = "&iquest;Cu&aacute;l es tu &eacute;poca del a&ntilde;o favorita?";
$randomq[] = "&iquest;Cu&aacute;l es tu banda favorita?";
$randomq[] = "&iquest;No puedes vivir sin qu&eacute; programa de televisi&oacute;n? ";
$randomq[] = "&iquest;Qu&eacute; instrumento te gustar&iacute;a tocar?";
$randomq[] = "Elige: &iquest;Pizza? &iquest;Hamburguesa? &iquest;Hot-Dog?";
$randomq[] = "El Deporte que m&aacute;s te gusta";
$randomq[] = "Para salir de fiesta vistes con...";
$randomq[] = "&iquest;Cu&aacute;l es tu pel&iacute;cula favorita?";
$randomq[] = "Perros, Gatos o algo m&aacute;s ex&oacute;tico.";
$randomq[] = "&iquest;Rojo? &iquest;Azul? &iquest;Rosa? u otro color.";
$randomq[] = "Elige: &iquest;MCR? &iquest;Panda? &iquest;Jonas Brothers?";
$randomq[] = "Elige: &iquest;Rock? &iquest;Pop? &iquest;Rap?";
$randomq[] = "&iquest;Qu&eacute; palabra te define?";
$randomq[] = "Elige &iquest;Habbo? &iquest;".$shortname."?";
$randomq[] = "&iquest;Cu&aacute;l es tu Staff favorito?";
$randomq[] = "&iquest;Postre o Jam&oacute;n?";
$randomq[] = "&iquest;Qu&eacute; otro idioma hablas?";
$randomq[] = "Lo mejor del mundo es...";
$randomq[] = "&iquest;Qu&eacute; furni te gusta m&aacute;s?";
$randomq[] = "Elige: &iquest;Laptop? &iquest;Escritorio?";
srand ((double) microtime() * 1000000);
$chosen = rand(0,count($randomq)-1);

if($key == "remove"){

mysql_query("DELETE FROM user_tags WHERE tag = '".$tag."' AND user_id = '".$my_id."' LIMIT 1") or die(mysql_error());
echo "SUCCESS";

} elseif($key == "p_remove"){

echo "<div id=\"profile-tags-container\">\n";

mysql_query("DELETE FROM user_tags WHERE tag = '".$tag."' AND user_id = '".$my_id."' LIMIT 1") or die(mysql_error());
$get_tags = mysql_query("SELECT * FROM user_tags WHERE user_id = '" . $my_id . "' ORDER BY id LIMIT 25") or die(mysql_error());
$rows = mysql_num_rows($get_tags);

	if($rows > 0){
		while ($row = mysql_fetch_assoc($get_tags)){
			printf("    <span class=\"tag-search-rowholder\">
        <a href=\"".$path."/tag/%s\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a><img border=\"0\" class=\"tag-delete-link tag-delete-link-%s\" onMouseOver=\"this.src='/web-gallery/images/buttons/tags/tag_button_delete_hi.gif'\" onMouseOut=\"this.src='/web-gallery/images/buttons/tags/tag_button_delete.gif'\" src=\"/web-gallery/images/buttons/tags/tag_button_delete.gif\"
        /></span>", $row['tag'], $row['tag'], $row['tag'], $row['tag']);
		}
	} else {
		echo "No hay tags para mostrar";
	}

echo "\n    <img id=\"tag-img-added\" border=\"0\" src=\"".$path."/web-gallery/images/buttons/tags/tag_button_added.gif\" style=\"display:none\"/>    
</div>";

} elseif($key == "p_list"){

echo "<div id=\"profile-tags-container\">\n";

mysql_query("DELETE FROM user_tags WHERE tag = '".$tag."' AND user_id = '".$my_id."' LIMIT 1") or die(mysql_error());
$get_tags = mysql_query("SELECT * FROM user_tags WHERE user_id = '" . $my_id . "' ORDER BY id LIMIT 25") or die(mysql_error());
$rows = mysql_num_rows($get_tags);

	if($rows > 0){
		while ($row = mysql_fetch_assoc($get_tags)){
			printf("    <span class=\"tag-search-rowholder\">
        <a href=\"".$path."/tag/%s\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a><img border=\"0\" class=\"tag-delete-link tag-delete-link-%s\" onMouseOver=\"this.src='/web-gallery/images/buttons/tags/tag_button_delete_hi.gif'\" onMouseOut=\"this.src='/web-gallery/images/buttons/tags/tag_button_delete.gif'\" src=\"/web-gallery/images/buttons/tags/tag_button_delete.gif\"
        /></span>", $row['tag'], $row['tag'], $row['tag'], $row['tag']);
		}
	} else {
		echo "No hay tags para mostrar";
	}

echo "\n    <img id=\"tag-img-added\" border=\"0\" src=\"/web-gallery/images/buttons/tags/tag_button_added.gif\" style=\"display:none\"/>    
</div>";

} elseif($key == "add"){

$tag = strtolower(FilterText($_POST['tagName']));
$filter = preg_replace("/[^a-z\d]/i", "", $tag);

	if(strlen($tag) < 2 || $filter !== $tag || strlen($tag) > 20){
	echo "invalidtag"; exit;
	} else {
	$check = mysql_query("SELECT * FROM user_tags WHERE user_id = '".$my_id."' AND tag = '".$tag."' LIMIT 1") or die(mysql_error());
	$num = mysql_num_rows($check);
		if($num > 0){
		echo "invalidtag"; exit;
		} else {
			if($tag_num > 20){
			echo "invalidtag"; exit;
			} else {
			mysql_query("INSERT INTO user_tags (user_id,tag) VALUES ('".$my_id."','".$tag."')");
			echo "valid"; exit;
			}
		}
	}

} elseif($key == "mytagslist"){

echo "   <div class=\"habblet\" id=\"my-tags-list\">\n\n";
            echo "<ul class=\"tag-list make-clickable\"> ";
	while($row = mysql_fetch_assoc($tmp)){
                    printf("<li><a href=\"".$path."/tag/%s\" class=\"tag\" style=\"font-size:10px\">%s</a>\n
                        <a class=\"tag-remove-link\"\n
                        title=\"Quitar tag\"\n
                        href=\"#\"></a></li>\n", $row['tag'], $row['tag']);
	}
            echo "</ul>";
if($tag_num < 20){
echo "     <form method=\"post\" action=\"tag_ajax.php?key=add\" onsubmit=\"TagHelper.addFormTagToMe();return false;\" >
    <div class=\"add-tag-form clearfix\">
		<a  class=\"new-button\" href=\"#\" id=\"add-tag-button\" onclick=\"TagHelper.addFormTagToMe();return false;\"><b>Tag a&ntilde;adido</b><i></i></a>
        <input type=\"text\" id=\"add-tag-input\" maxlength=\"20\" style=\"float: right\"/>
        <em class=\"tag-question\">" . $randomq[$chosen] . "</em>
    </div>
    <div style=\"clear: both\"></div> 
    </form>";
}
echo "    </div>

<script type=\"text/javascript\">

    TagHelper.setTexts({
        tagLimitText: \"Has alcanzado el l&iacute;mite de tags. Debes eliminar alguno para a&ntilde;adir m&aacute;s.\",
        invalidTagText: \"Tag inv&aacute;lido\",
        buttonText: \"OK\"
    });
        TagHelper.bindEventsToTagLists();

</script>\n";

}
?>