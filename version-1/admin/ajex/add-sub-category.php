<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $name = mysql_real_escape_string($_POST['name']);
    $order = mysql_real_escape_string($_POST['order']);
    $img = mysql_real_escape_string($_POST['img']);
    $main_cat_id = mysql_real_escape_string($_POST['main_cat_id']);
    $check = mysql_query("SELECT * FROM `sub_cats` WHERE `caption` = '{$name}'");
    if (mysql_num_rows($check) > 0) {
       echo error(' This Category is already exist');
    }else{
        $q = mysql_query("INSERT INTO `sub_cats`(`sub_cat_id`, `main_cat_id`, `caption`, `img`, `sorting_order`) VALUES (NULL,'{$main_cat_id}','{$name}','{$img}','{$order}')");
        if ($q) {
        		echo success(' Your New category Add');
                echo '<meta http-equiv="refresh" content="2; url=sub-category.php?id='.$main_cat_id.'">';
        }else{
        		echo error(mysql_error());
        }
    }
}
?>
