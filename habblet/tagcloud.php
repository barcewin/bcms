<?php
if($_GET['sp'] == "plain"){
require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');
echo "<div class=\"habblet box-content\">";
} elseif(!defined("IN_HOLOCMS")){ exit; }

$result = mysql_query("SELECT tag, COUNT(id) AS quantity FROM user_tags GROUP BY tag ORDER BY quantity DESC LIMIT 20");
$number = mysql_num_rows($result);

if($number > 0){
echo "	    <ul class=\"tag-list\">";
	for($i=0;($array[$i] = @    mysql_fetch_array($result, MYSQL_ASSOC))!="";$i++)
        {
            $row[] = $array[$i];
        }
	sort($row);
	$i = -1;
	while($i <> $number){
		$i++;
		$tag = $row[$i]['tag'];
		$count = $row[$i]['quantity'];
		$tags[$tag] = $count;
	}
		
		$max_qty = max(array_values($tags));
		$min_qty = min(array_values($tags));
		$spread = $max_qty - $min_qty;

		if($spread == 0){ $spread = 1; }

		$step = (200 - 100)/($spread);

		foreach($tags as $key => $value){
		    $size = 50 + (($value - $min_qty) * $step);
		    $size = ceil($size);
		    echo "<li><a href=\"".$path."/tag/".strtolower($key)."\" class=\"tag\" style=\"font-size:".$size."%\">".trim(strtolower($key))."</a> </li>\n";
		}

echo "</ul>";
} else {
echo "<div>Zurzeit gibts keine tags</div>";
}

if($_GET['sp'] == "plain"){ ?>
    <div class="tag-search-form">
<form name="tag_search_form" action="tag" class="search-box">
    <input name="tag" id="search_query" value="" class="search-box-query" style="float: left;" type="text">
	<a onclick="$(this).up('form').submit(); return false;" href="#" class="new-button search-icon" style="float: left;"><b><span></span></b><i></i></a>	
</form>    </div>
<?php } ?>
