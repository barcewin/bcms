<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php'); 

if($user_rank < 6){ exit; }

?>

<p>You are about to delete a compelete topic. Are you sure?</p>

<p>
<a href="#" class="new-button" id="discussion-action-cancel"><b>Cancel</b><i></i></a>
<a href="#" class="new-button" id="discussion-action-ok"><b>Proceed</b><i></i></a>
</p>

<div class="clear"></div>