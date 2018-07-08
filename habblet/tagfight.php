<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$tag_1 = FilterText($_POST['tag1']);
$tmp = mysql_query("SELECT id FROM cms_tags WHERE tag = '".FilterText($tag_1)."'") or die(mysql_error());
$tag_1_results = mysql_num_rows($tmp);
$tag_2 = FilterText($_POST['tag2']);
$tmp = mysql_query("SELECT id FROM cms_tags WHERE tag = '".FilterText($tag_2)."'") or die(mysql_error());
$tag_2_results = mysql_num_rows($tmp);

if(empty($tag_1) || empty($tag_2)){ exit; }

if($tag_1_results == $tag_2_results){
$tag_1 = FilterText($_POST['tag1']);
$tag_2 = FilterText($_POST['tag2']);
$end = 0;
} elseif($tag_1_results > $tag_2_results){
$tag_1 = "<b>" . FilterText($_POST['tag1']) . "</b>";
$tag_2 = FilterText($_POST['tag2']);
$end = 2;
} elseif($tag_1_results < $tag_2_results){
$tag_1 = FilterText($_POST['tag1']);
$tag_2 = "<b>" . FilterText($_POST['tag2']) . "</b>";
$end = 1;
}

echo "			<div id=\"fightResultCount\" class=\"fight-result-count\">
				"; if($end == 0){ echo "&iexcl;Empate!"; } else { echo "El ganador es:"; } echo "<br />
			    ".HoloText($tag_1)."
			(".$tag_1_results.") puntos
            <br/>
                ".HoloText($tag_2)."
            (".$tag_2_results.") puntos
		    </div>
			<div class=\"fight-image\">
					<img src=\"./web-gallery/images/tagfight/tagfight_end_".$end.".gif\" alt=\"\" name=\"fightanimation\" id=\"fightanimation\" />
                <a id=\"tag-fight-button-new\" href=\"#\" class=\"new-button\" onclick=\"TagFight.newFight(); return false;\"><b>&iquest;Otra vez?</b><i></i></a>
                <a id=\"tag-fight-button\" href=\"#\" style=\"display:none\" class=\"new-button\" onclick=\"TagFight.init(); return false;\"><b>Comenzar</b><i></i></a>
            </div>
";

?>