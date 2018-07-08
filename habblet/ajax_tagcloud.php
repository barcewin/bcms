<?php

if($_GET['sp'] == "plain"){
require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');
echo "<div class=\"habblet box-content\">";
} elseif(!defined("IN_HOLOCMS")){ exit; }

$result = mysql_query("SELECT name, COUNT(id) AS quantity FROM users_tags GROUP BY name ORDER BY rand() LIMIT 20");
$number = mysql_num_rows($result);

if($number > 0){
echo "	    <ul class=\"tag-list\">";

	while($row = mysql_fetch_array($result)){
		$tags[$row['tag']] = $row['quantity'];
	}

	$max_qty = max(array_values($tags));
	$min_qty = min(array_values($tags));
	$spread = $max_qty - $min_qty;

	if($spread == 0){ $spread = 1; }

	$step = (200 - 100)/($spread);

	foreach($tags as $key => $value){
	    $size = 100 + (($value - $min_qty) * $step);
	    $size = ceil($size);
	    echo "<li><a href=\"".$path."/tag/".strtolower($key)."\" class=\"tag\" style=\"font-size:".$size."%\">".trim(strtolower($key))."</a> </li>\n";
	}

echo "</ul>";
} else {
echo "<div>No hay tags disponibles actualmente.</div>";
}

if($_GET['sp'] == "plain"){ ?>
    <div class="tag-search-form">
<form name="tag_search_form" action="tags" class="search-box">
    <input name="tag" id="search_query" value="" class="search-box-query" style="float: left;" type="text">
	<a onclick="$(this).up('form').submit(); return false;" href="#" class="new-button search-icon" style="float: left;"><b><span></span></b><i></i></a>	
</form>    </div>
<?php } ?>
