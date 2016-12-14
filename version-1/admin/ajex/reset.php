<?php
$page ='reset';
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
	$email = mysql_real_escape_string($_POST['email']);
   	if (reset_pass($email,$config['admin_url'])) {
		echo success(' Please Check Your Email');
	}else{
		echo error(' Invalid Email Address');
	}
}
?>