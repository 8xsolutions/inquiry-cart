<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $logo = mysql_real_escape_string($_POST['logo']);
    $cname = mysql_real_escape_string($_POST['cname']);
    $livein = mysql_real_escape_string($_POST['livein']);
    $country = mysql_real_escape_string($_POST['country']);
    $description = mysql_real_escape_string($_POST['description']);
    $facebook = mysql_real_escape_string($_POST['facebook']);
    $twitter = mysql_real_escape_string($_POST['twitter']);
    $google = mysql_real_escape_string($_POST['google']);
    $flicr = mysql_real_escape_string($_POST['flicr']);
    $youtube = mysql_real_escape_string($_POST['youtube']);
    $address  = mysql_real_escape_string($_POST['address']);
    $address2 = mysql_real_escape_string($_POST['address2']);
    $phone = mysql_real_escape_string($_POST['phone']);
    $cell = mysql_real_escape_string($_POST['cell']);
    $skype = mysql_real_escape_string($_POST['skype']);
    $web_unlock_pass = mysql_real_escape_string($_POST['web_unlock_pass']);
    
    $q = mysql_query("UPDATE `setting` SET `logo`='{$logo}',`cname`='{$cname}',`livein`='{$livein}',`country`='{$country}',`description`='{$description}',`facebook`='{$facebook}',`google`='{$google}',`twitter`='{$twitter}',`flicr`='{$flicr}',`youtube`='{$youtube}',`address`='{$address}',`address2`='{$address2}',`phone`='{$phone}',`cell`='{$cell}',`skype`='{$skype}',`web_unlock_pass` = '{$web_unlock_pass}' WHERE `id` = 1");
    if ($q) {
    		echo success(' Redirect please wait');
    		echo redirect($config['admin_url']."setting.php");
    }else{
    		echo error(' invalid details Please Try Again');
    }
}
?>
