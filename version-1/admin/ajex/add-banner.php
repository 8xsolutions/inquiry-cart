<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $name = mysql_real_escape_string($_POST['name']);
    $image = mysql_real_escape_string($_POST['image']);
    $url = mysql_real_escape_string($_POST['url']);
    $q = mysql_query("INSERT INTO `banner`(`id`, `name`, `image`, `url`) VALUES ('','$name','$image','$url')");
    if ($q) {
    		echo success(' Redirect please wait');
    		echo redirect($config['admin_url']."banner.php");
    }else{
    		echo error(' invalid details Please Try Again');
    }
}
?>
