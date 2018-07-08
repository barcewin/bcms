<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$songid = FilterText($_POST['songId']);
$id = FilterText($_POST['widgetId']);

mysql_query("UPDATE homes_stickers SET var = '".$songid."' WHERE id = '".$id."'");?>

<embed type="application/x-shockwave-flash"
src="<?php echo $path; ?>web-gallery/flash/traxplayer/traxplayer.swf" name="traxplayer" quality="high"
base="<?php echo $path; ?>web-gallery/flash/traxplayer/" allowscriptaccess="always" menu="false"
wmode="transparent" flashvars="songUrl=<?php echo $path; ?>/myhabbo/trax_song.php?songId=<?php echo $songid; ?>&amp;sampleUrl=http://images.habbohotel.com/dcr/hof_furni//mp3/" height="66" width="210" />