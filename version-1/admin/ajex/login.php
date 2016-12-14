<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $user = mysql_real_escape_string($_POST['user']);
    $pass = md5(mysql_real_escape_string($_POST['pass']));
    if (empty($_POST['check']) || $_POST['check'] == 'no') {
    	$checkbox = '';
    }else{
    	$checkbox = mysql_real_escape_string($_POST['check']);
    }
    if (login($user,$pass,$checkbox,$config['key']) == true) {
		echo success(' Redirect please wait');
		echo redirect($config['admin_url']);
	}else{
		echo error(' invalid username or password');
	}
}
?>