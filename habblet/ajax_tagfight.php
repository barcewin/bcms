<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$sql = mysql_query("SELECT * FROM user_tags WHERE tag = '".FilterText($_POST['tag1'])."'");
$tag_1_results = mysql_num_rows($sql);
$sql = mysql_query("SELECT * FROM user_tags WHERE tag = '".FilterText($_POST['tag2'])."'");
$tag_2_results = mysql_num_rows($sql);

$tag_1 = HoloText($_POST['tag1']);
$tag_2 = HoloText($_POST['tag2']);

if($tag_1_results == $tag_2_results){

$end = 0;
} elseif($tag_1_results > $tag_2_results){
$tag_1 = "<b>" . HoloText($_POST['tag1']) . "</b>";
$end = 2;
} elseif($tag_1_results < $tag_2_results){
$tag_2 = "<b>" . HoloText($_POST['tag2']) . "</b>";
$end = 1;
}

echo "<div id=\"fightResultCount\" class=\"fight-result-count\">";
if($end == 0){ echo"Empate"; } else { echo"El ganador es:"; }
echo "<br>".$tag_1." (".$tag_1_results.") golpes
      <br>".$tag_2." (".$tag_2_results.") golpes
</div>

<div class=\"fight-image\">
<img src=\"".$path."/web-gallery/images/tagfight/tagfight_end_".$end.".gif\" alt=\"\" name=\"fightanimation\" id=\"fightanimation\" />
<a id=\"tag-fight-button-new\" href=\"#\" class=\"new-button\" onclick=\"TagFight.newFight(); return false;\"><b>&iquest;Otra ronda?</b><i></i></a>
<a id=\"tag-fight-button\" href=\"#\" style=\"display:none\" class=\"new-button\" onclick=\"TagFight.init(); return false;\"><b>Comenzar</b><i></i></a>
</div>"; ?>