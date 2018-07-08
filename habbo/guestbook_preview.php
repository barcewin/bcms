<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

$ownerid = FilterText($_POST['ownerId']);
$message = HoloText($_POST["message"],false,true); 

$row = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$my_id."' LIMIT 1"));
?>

<ul class="guestbook-entries">
	<li id="guestbook-entry--1" class="guestbook-entry">
		<div class="guestbook-author">
			<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $row['look']; ?>&direction=2&head_direction=2&gesture=sml&size=s" alt="<?php echo $row['username'] ?>" title="<?php echo $row['username'] ?>"/>
		</div>
		<div class="guestbook-message">
			<div class="<?php if($row['online'] > 0){ ?>online<?php }else{ ?>offline<?php } ?>">
				<a href="../home/<?php echo $row['username']; ?>"><?php echo $row['username'] ?></a>
			</div>
			<p><?php echo $message; ?></p>
		</div>
		<div class="guestbook-cleaner">&nbsp;</div>
		<div class="guestbook-entry-footer metadata"></div>
	</li>
</ul>

<div class="guestbook-toolbar clearfix">
<a href="#" class="new-button" id="guestbook-form-continue"><b>Veranderen</b><i></i></a>
<a href="#" class="new-button" id="guestbook-form-post"><b>Sturen</b><i></i></a>	
</div>