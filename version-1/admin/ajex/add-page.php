<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    if (empty($_POST['name'])  || empty($_POST['detail'])) {
       echo warning(' Please Fill all field');
    }else{
        $name = mysql_real_escape_string($_POST['name']);
        $detail = mysql_real_escape_string($_POST['detail']);
        $add = mysql_query("INSERT INTO `page`(`pid`, `pname`, `pcont`) VALUES (NULL,'{$name}','{$detail}')");
        if ($add) {
            echo success(" Your Page add success fully");
            redirect($config['admin_url'].'new-page.php');
        }else{
            echo warning(mysql_error());
        }
    }
}
?>