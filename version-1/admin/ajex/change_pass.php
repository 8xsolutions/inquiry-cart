<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
	if (empty($_POST['pass']) or empty($_POST['pass2'])) {
		echo warning(' Please Enet Your password');
	}else{
		if ($_POST['pass'] != $_POST['pass2']) {
			echo warning(" Your Password is not match");
		}else{
			$check = change_pass_done($_POST['id'],md5(mysql_real_escape_string($_POST['pass'])));
			if ($check == true) {
				echo success(' Your Password Cahange successfully');
			}else{
				echo warning(" Please Try Again Or your reset key is expire");
			}
		}
	}
}
?>