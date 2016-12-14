<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $title = mysql_real_escape_string($_POST['title']);
    $keyword = mysql_real_escape_string($_POST['keyword']);
    $description = mysql_real_escape_string($_POST['description']);
    $q = mysql_query("UPDATE `seo` SET `title`='{$title}',`keyword`='{$keyword}',`description`='{$description}' WHERE `id` = 1");
    if ($q) {
    		echo success(' Redirect please wait');
    		echo redirect($config['admin_url']."seo.php");
    }else{
    		echo error(' invalid details Please Try Again');
    }
}
?>
