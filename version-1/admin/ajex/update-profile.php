<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $name = mysql_real_escape_string($_POST['name']);
    $image = mysql_real_escape_string($_POST['image']);
    $user = mysql_real_escape_string($_POST['user']);
    $email = mysql_real_escape_string($_POST['email']);
    echo $about = mysql_real_escape_string($_POST['about']);
    $q = mysql_query("UPDATE `admin` SET `user`='{$user}',`email`='{$email}',`name`='{$name}',`image`='{$image}',`about`='{$about}' WHERE `id` = '1'");
    if ($q) {
    		echo success(' Redirect please wait');
    		echo redirect($config['admin_url']."profile.php");
    }else{
    		echo error(' invalid details Please Try Again');
    }
}
?>
