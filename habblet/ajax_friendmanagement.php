<?php

require_once('../data_classes/server-data.php_data_classes-core.php.php');
require_once('../data_classes/server-data.php_data_classes-session.php.php');

if(isset($_GET['pageNumber'])){

$page = FilterText($_GET['pageNumber']);
$pagesize = FilterText($_GET['pageSize']);

?>
                        <div id="friend-list" class="clearfix">
<div id="friend-list-header-container" class="clearfix">
    <div id="friend-list-header">
        <div class="page-limit">
            <div class="big-icons friend-header-icon">Amigos
                <br />Mostrar

           		<?php if($pagesize == 30){ ?>
                30 |
                <a class="category-limit" id="pagelimit-50">50</a> |
                <a class="category-limit" id="pagelimit-100">100</a>
                <?php }elseif($pagesize == 50){ ?>
                <a class="category-limit" id="pagelimit-30">30</a> |
				50 |
                <a class="category-limit" id="pagelimit-100">100</a>
                <?php }elseif($pagesize == 100){ ?>
                <a class="category-limit" id="pagelimit-30">30</a> |
				<a class="category-limit" id="pagelimit-50">50</a> |
                100
                <?php } ?>
            </div>
        </div>
    </div>
	<div id="friend-list-paging">
	<?php
		if($page <> 1){
		$pageminus = $page - 1;
		echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$pageminus."\">&lt;&lt;</a> |";
		}
		$afriendscount = mysql_query("SELECT COUNT(*) FROM messenger_friendships WHERE user_one_id = '".$my_id."'") or die(mysql_error());
		$friendscount = mysql_result($afriendscount, 0);

		$pages = ceil($friendscount / $pagesize);

		if($pages == 1){

		echo "1";

		}else{

		$n = 0;

		while ($n < $pages) {
			$n++;
			if($n == $page){
			echo $n." |";
			} else {
			echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$n."\">".$n."</a> |";
			}
		}

		if($page <> $pages){
		$pageplus = $page + 1;
		echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$pageplus."\">&gt;&gt;</a>";
		}
		}
	?>

        </div>
    </div>


<form id="friend-list-form">
    <table id="friend-list-table" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr class="friend-list-header">
                <td class="friend-select" />
                <td class="friend-name table-heading">Nombre</td>
                <td class="friend-login table-heading">&Uacute;ltima vez conectado</td>
                <td class="friend-remove table-heading">Eliminar</td>
            </tr>
           <?php
		   $i = 0;
		   $offset = $pagesize * $page;
		   $offset = $offset - $pagesize;
		   $getem = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$my_id."' LIMIT ".$pagesize." OFFSET ".$offset."") or die(mysql_error());

		   while ($row = mysql_fetch_assoc($getem)) {
		           $i++;

		           if(IsEven($i)){
		               $even = "odd";
		           } else {
		               $even = "even";
		           }

		           if($row['id_friend'] == $my_id){
		           		$friendsql = mysql_query("SELECT * FROM users WHERE id = '".$row['user_one_id']."'");
		           } else {
		           		$friendsql = mysql_query("SELECT * FROM users WHERE id = '".$row['user_two_id']."'");
		           }

		           $friendrow = mysql_fetch_assoc($friendsql);



printf("   <tr class=\"%s\">
               <td><input type=\"checkbox\" name=\"friendList[]\" value=\"%s\" /></td>
               <td class=\"friend-name\">
                %s
               </td>
               <td class=\"friend-login\" title=\"%s\">%s</td>
               <td class=\"friend-remove\"><div id=\"remove-friend-button-%s\" class=\"friendmanagement-small-icons friendmanagement-remove remove-friend\"></div></td>
           </tr>", $even, $friendrow['id'], $friendrow['username'], date('d.m.Y  H:i:s', $friendrow['last_online']), date('d.m.Y  H:i:s', $friendrow['last_online']), $friendrow['id']);
		   }
		?>
        </tbody>
    </table>
    <a class="select-all" id="friends-select-all" href="#">Seleccionar todos</a> |
    <a class="deselect-all" href=#" id="friends-deselect-all">Cancelar selecci&oacute;n</a>
</form>                        </div>
    <script type="text/javascript">
        new FriendManagement({ currentCategoryId: 0, pageListLimit: <?php echo $pagesize; ?>, pageNumber: <?php echo $page; ?>});
    </script>



<?php } elseif(isset($_POST['searchString'])){
$search = FilterText($_POST['searchString']);
$pagesize = FilterText($_POST['pageSize']);
$page = 1;
?>
                        <div id="friend-list" class="clearfix">
<div id="friend-list-header-container" class="clearfix">
    <div id="friend-list-header">
        <div class="page-limit">
            <div class="big-icons friend-header-icon">Amigos
                <br />Mostrar

           		<?php if($pagesize == 30){ ?>
                30 |
                <a class="category-limit" id="pagelimit-50">50</a> |
                <a class="category-limit" id="pagelimit-100">100</a>
                <?php }elseif($pagesize == 50){ ?>
                <a class="category-limit" id="pagelimit-30">30</a> |
				50 |
                <a class="category-limit" id="pagelimit-100">100</a>
                <?php }elseif($pagesize == 100){ ?>
                <a class="category-limit" id="pagelimit-30">30</a> |
				<a class="category-limit" id="pagelimit-50">50</a> |
                100
                <?php } ?>
            </div>
        </div>
    </div>
	<div id="friend-list-paging">
	<?php
		if($page <> 1){
		$pageminus = $page - 1;
		echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$pageminus."\">&lt;&lt;</a> |";
		}
		$i = 0;
	    $list = 0;
		$sql = mysql_query("SELECT * FROM friendships WHERE id_user = '".$my_id."'") or die(mysql_error());
		while ($row = mysql_fetch_assoc($sql)) {
			   $i++;

			   if($row['id_friend'] == 1){
					$friendsql = mysql_query("SELECT * FROM users WHERE id = '".$row['user_one_id']."' AND username LIKE '%".$search."%'");
			   } else {
					$friendsql = mysql_query("SELECT * FROM users WHERE id = '".$row['user_two_id']."' AND username LIKE '%".$search."%'");
			   }
	   $list = $list + mysql_num_rows($friendsql);
		}

		$pages = ceil($list / $pagesize);

		if($pages == 1){

		echo "1";

		}else{

		$n = 0;

		while ($n < $pages) {
			$n++;
			if($n == $page){
			echo $n." |";
			} else {
			echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$n."\">".$n."</a> |";
			}
		}

		if($page <> $pages){
		$pageplus = $page + 1;
		echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$pageplus."\">&gt;&gt;</a>";
		}
		}
	?>

        </div>
    </div>


<form id="friend-list-form">
    <table id="friend-list-table" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr class="friend-list-header">
                <td class="friend-select" />
                <td class="friend-name table-heading">Nombre</td>
                <td class="friend-login table-heading">&Uacute;ltima vez conectado</td>
                <td class="friend-remove table-heading">Eliminar</td>
            </tr>
           <?php
		   $i = 0;
		   $n = 0;
		   $getem = mysql_query("SELECT * FROM friendships WHERE id_user = '".$my_id."'") or die(mysql_error());

		   while ($row = mysql_fetch_assoc($getem)) {
		           $i++;

		           if($row['id_friend'] == $my_id){
		           		$friendsql = mysql_query("SELECT * FROM users WHERE id = '".$row['user_one_id']."' AND username LIKE '%".$search."%'");
		           } else {
		           		$friendsql = mysql_query("SELECT * FROM users WHERE id = '".$row['user_two_id']."' AND username LIKE '%".$search."%'");
		           }

		           $friendrow = mysql_fetch_assoc($friendsql);

		           if(!empty($friendrow['username'])){

		           $n++;

				   if(IsEven($n)){
					   $even = "odd";
				   } else {
					   $even = "even";
		           }

printf("   <tr class=\"%s\">
               <td><input type=\"checkbox\" name=\"friendList[]\" value=\"%s\" /></td>
               <td class=\"friend-name\">
                %s
               </td>
               <td class=\"friend-login\" title=\"%s\">%s</td>
               <td class=\"friend-remove\"><div id=\"remove-friend-button-%s\" class=\"friendmanagement-small-icons friendmanagement-remove remove-friend\"></div></td>
           </tr>", $even, $friendrow['id'], $friendrow['username'], date('d.m.Y  H:i:s', $friendrow['last_online']), date('d.m.Y  H:i:s', $friendrow['last_online']), $friendrow['id']);
		   }
		   }
		?>
        </tbody>
    </table>
    <a class="select-all" id="friends-select-all" href="#">Seleccionar todos</a> |
    <a class="deselect-all" href=#" id="friends-deselect-all">Cancelar selecci&oacute;n</a>
</form>                        </div>
    <script type="text/javascript">
        new FriendManagement({ currentCategoryId: 0, pageListLimit: <?php echo $pagesize; ?>, pageNumber: <?php echo $page; ?>});
    </script>
<?php } ?>