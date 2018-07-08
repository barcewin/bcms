<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

if(isset($_POST['searchString'])) {
$page = FilterText($_POST['pageNumber']);
$search = FilterText($_POST['searchString']);
$sql = mysql_query("SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY username ASC");
$count = mysql_num_rows($sql);
$pages = ceil($count / 10);
if($page == null){ $page = 1; }
$limit = 10;
$offset = $page - 1;
$offset = $offset * 10;
$sql = mysql_query("SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY username ASC LIMIT $limit OFFSET $offset");
if(mysql_num_rows($sql) > 0) {
echo '<ul class="habblet-list">';
while($row = mysql_fetch_assoc($sql)) {
$friendsql = mysql_query("SELECT user_two_id FROM messenger_friendships WHERE user_one_id = '".$my_id."' and user_two_id = '".$row['id']."'");
$friendrow = mysql_fetch_assoc($friendsql);
$friendsql2 = mysql_query("SELECT from_id FROM messenger_requests WHERE to_id = '".$my_id."' and from_id = '".$row['id']."' or to_id = '".$my_id."' and from_id = '".$row['id']."'");
$friendrow2 = mysql_fetch_assoc($friendsql2);
		        $i++;

        if(IsEven($i)){
            $even = "odd";
        } else {
            $even = "even";
        } ?>

              <li class="<?php echo $even; ?> offline" homeurl="./home/<?php echo HoloText($row['username']); ?>" style="background-image: url(http://www.habbo.es/habbo-imaging/avatarimage?figure=<?php echo $row['look']; ?>&direction=2&head_direction=2&gesture=sml&size=s)">
	            	    <div class="item">
	            		    <b><?php echo HoloText($row['username']); ?></b><br />
                              <?php echo $row['motto']; ?>

	            	    </div>
	            	    <div class="lastlogin">
	            	    	<b>&Uacute;ltima vez conectado:</b><br />

	            	    		<span title="<?php echo date('d.m.Y H:i:s', $row['last_online']); ?>"><?php echo date('d.m.Y H:i:s', $row['last_online']); ?></span>
	            	    </div>
                            <?php if($friendrow['user_two_id'] !== $my_id && $friendrow2 < 1){ ?>
	            	    <div class="tools">
	            	    		<a href="#" class="add" avatarid="<?php echo $row['id']; ?>" title="Enviar petici&oacute;n de amistad"></a>
	            	    </div>
                            <?php } ?>
	            	    <div class="clear"></div>
	                </li>

<?php			} ?>
							    <div id="habblet-paging-avatar-habblet-list-container">
        <p id="avatar-habblet-list-container-list-paging" class="paging-navigation">
		            	 <?php if($page > 1) { ?><a href="#" class="avatar-habblet-list-container-list-paging-link" id="avatar-habblet-list-container-list-previous">&laquo;</a><?php } else { ?><span class="disabled">&laquo;</span><?php } ?>
		<?php           
		$i = 0;
		$n = $pages;
		while ($i <> $n){
			$i++;
			if ($i < $page + 8){
				if($i == $page){ echo "<span class=\"current\">".$i."</span>\n";
				} else {
					if ($i + 4 >= $page && $page + 4 >= $i){
						echo "<a href=\"#\" class=\"avatar-habblet-list-container-list-paging-link\" id=\"avatar-habblet-list-container-list-page-".$i."\">".$i."</a>\n";
					}
				}
			}
		}
		?>
		<?php if($page < $pages) { ?><a href="#" class="avatar-habblet-list-container-list-paging-link" id="avatar-habblet-list-container-list-next">&raquo;</a><?php }else{ ?><span class="disabled">&raquo;</span><?php } ?>
			        </p>
        <input type="hidden" id="avatar-habblet-list-container-pageNumber" value="<?php echo $page; ?>"/>
        <input type="hidden" id="avatar-habblet-list-container-totalPages" value="<?php echo $pages; ?>"/>
    </div>
				<?php
			}else{
			echo "<div class=\"box-content\">
                ".$shortname." no encontrado. Asegurate que has escrito el nombre correctamente.  <br>
       </div>";
		}
}

?>