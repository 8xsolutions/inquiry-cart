<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    if (empty($_POST['name'])  || empty($_POST['detail']) || empty($_POST['id'])) {
       echo warning(' Please Fill all field');
    }else{
        $name = mysql_real_escape_string($_POST['name']);
        $detail = mysql_real_escape_string($_POST['detail']);
        $id = mysql_real_escape_string($_POST['id']);
        $add = mysql_query("UPDATE `page` SET `pname`='{$name}',`pcont`='{$detail}' WHERE `pid` = '{$id}'");
        if ($add) {
            echo success(" Your Page update success fully");
            redirect($config['admin_url'].'edit-page.php?id='.$id);
        }else{
            echo warning(mysql_error());
        }
    }
}
?>