<?php

if($bypass != true){
require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

$search = FilterText($_GET['tag']);
$pagenum = FilterText($_GET['pageNumber']);

if(!isset($_GET['pageNumber']) || $pagenum < 1){
	$pagenum = 1;
}

$correct = HoloText($search);

if(strlen($search) > 20 || strlen($search) < 1 || $search != $correct){
	$search = "";
}
}

echo"<div id=\"tag-search-habblet-container\">";

$count['total'] = mysql_evaluate("SELECT COUNT(*) FROM user_tags WHERE tag = '".$search."'");
$count['pageminus'] = $pagenum - 1;
$count['offset'] = $count['pageminus'] * 10;
$sql = mysql_query("SELECT * FROM user_tags WHERE tag = '".$search."' ORDER BY id DESC LIMIT 10 OFFSET ".$count['offset']);
$count['thispage'] = mysql_num_rows($sql);
$count['pages'] = ceil($count['total'] / 10);
$count['shown'] = $count['offset'] + 10;
if($count['shown'] > $count['total']){ $count['shown'] = $count['total']; }

$havetag = mysql_evaluate("SELECT COUNT(*) FROM user_tags WHERE tag = '".$search."' AND user_id = '".$my_id."'");
?>

<form name="tag_search_form" action="<?php echo $path; ?>/tag" class="search-box">
<input type="text" name="tag" id="search_query" value="<?php if(isset($search)){ echo HoloText($search); } ?>" class="search-box-query" style="float: left"/>
<a onclick="$(this).up('form').submit(); return false;" href="#" class="new-button search-icon" style="float: left"><b><span></span></b><i></i></a>	
</form>

<p class="search-result-count">

<?php 

if($count['total'] == 0){ echo"Kein Ergebnis erzielt."; }else{
echo $count['offset'] + 1; ?> - <?php echo $count['shown']; ?> / <?php echo $count['total']; } ?></p>
<?php if($havetag == 0 && $my_id != 0 && $search != ""){ ?>

<p id="tag-search-add" class="clearfix"><span style="float:left">Etiquetate con:</span>
<a id="tag-search-tag-add" href="#" class="new-button" style="float:left" onclick="TagHelper.addThisTagToMe('<?php echo HoloText($search); ?>',false);return false;">
<b><?php echo HoloText($search); ?></b><i></i></a>
</p>
       <p id="tag-search-add-result">OK</p>
       <script type="text/javascript">
       document.observe("dom:loaded", function() {
            TagHelper.setTexts({
            tagLimitText: "Has alcanzado el l&iacute;mite de YoSoys",
            invalidTagText: "YoSoy inv&aacute;lido",
            buttonText: "OK"
            });
           TagHelper.init(<?php echo $my_id; ?>);
        });
        </script>
<?php } ?>
        <p class="search-result-divider"></p>
		
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="search-result">
<tbody>

<?php

$i = 0;
while($row = mysql_fetch_assoc($sql)){

$i++;

if(IsEven($i)){
	$even = "even";
}else{
	$even = "odd";
}

$sql2 = mysql_query("SELECT * FROM users WHERE id = '".$row['user_id']."' LIMIT 1");
$userdata = mysql_fetch_assoc($sql2);
?>

<tr class="<?php echo $even; ?>">

<td class="image" style="width:39px;">
<img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=<?php echo $userdata['look']; ?>&size=s&direction=4&head_direction=4&gesture=sml" alt="<?php echo $userdata['username']; ?>" align="left">
</td>

<td class="text">
<a href="<?php echo $path; ?>/home/<?php echo $userdata['username']; ?>" class="result-title"><?php echo $userdata['username']; ?></a><br/>
<span class="result-description"><?php echo $userdata['motto']; ?></span>

<ul class="tag-list">

<?php
$sql3 = mysql_query("SELECT tag FROM user_tags WHERE user_id = '".$row['user_id']."'");
while($tag = mysql_fetch_assoc($sql3)){
?>
<li><a href="<?php echo $path; ?>/tag/<?php echo HoloText($tag[tag]); ?>" class="tag" style="font-size:10px"><?php echo HoloText($tag[tag]); ?></a> </li>
<?php } ?>

</ul>

</td>
</tr>
			
<?php } ?>

</tbody>
</table>

<?php
$output = "";
if($count['pages'] > 1){
if($pagenum == "1"){
	$output = $output.Erste."\n";
}else{
	$output = $output."<a href=\"".$path."/tag/".HoloText($search)."&pageNumber=1\">Primero</a>\n"; }
$i = 0;
while($i < $count['pages']){
$i++;
if($i == $pagenum){
	$output = $output.$i."\n";
}else{
	$output = $output."<a href=\"".$path."/tag/".HoloText($search)."&pageNumber=".$i."\">".$i."</a>\n";
}

}
if($pagenum == $count['pages']){
	$output = $output.Letzte."\n";
}else{
	$output = $output."<a href=\"".$path."/tag/".HoloText($search)."&pageNumber=".$count['pages']."\">&Uacute;ltimo</a>\n";
}
}else{
$output = "1";
}
if(!isset($_GET['tag']) || $count['total'] == 0){ $output = ""; }
?>
        <p class="search-result-navigation">
            <?php echo $output; ?>
		</p>
</div>