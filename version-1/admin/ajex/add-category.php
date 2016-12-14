<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $name = mysql_real_escape_string($_POST['name']);
    $order = mysql_real_escape_string($_POST['order']);
    $img = mysql_real_escape_string($_POST['img']);
    $check = mysql_query("SELECT * FROM main_cats WHERE caption = '{$name}'");
    if (mysql_num_rows($check) > 0) {
       echo error(' This Category is already exist');
    }else{
        $q = mysql_query("INSERT INTO `main_cats`(`main_cat_id`, `caption`, `sorting_order`,`img`) VALUES (NULL,'{$name}','{$order}','{$img}')");
        if ($q) {
        		echo success(' Your New category Add');
                echo '<meta http-equiv="refresh" content="0; url=category.php">';
        }else{
        		echo error(mysql_error());
        }
    }
}
?>
