<?php
session_start();
// Now Connect Function
$connect = connect($config['db_host'],$config['db_user'],$config['db_pass'],$config['db']);
if ($connect != true) {
	redirect_error("Database Not Found");
}
// End Connect Function
##############################################################################
# check cookie is available
##############################################################################
if (isset($_COOKIE['login_hash'])) {
	$lhash = $_COOKIE['login_hash'];
	$login_hash = Decrypt_Helper($lhash, $config['key']);
	$ld = explode('-', $login_hash);
	// first chek record is available?
	$check_r = mysql_query("SELECT * FROM `admin` WHERE `user` = '".mysql_real_escape_string($ld['0'])."' AND `login_hash` = '{$lhash}'");
	if (mysql_num_rows($check_r) > 0) {
		$_SESSION['user'] = $ld[0];
		$_SESSION['login'] = 'login';
	}else{
		// Login Bufer
		if (!isset($_SESSION['user']) OR $_SESSION['login'] !== "login") {
			$self = end(explode('/', $_SERVER['PHP_SELF']));
			if ( $self == 'login.php' || $self == 'reset.php') {
				
			}else{
				redirect($config['admin_url'].'login.php');
			}
		}
		// End Login Bufer
	}
}else{
	// Login Bufer
	if (!isset($_SESSION['user']) OR $_SESSION['login'] !== "login") {
		$self = basename($_SERVER['PHP_SELF']);
		if ( $self == 'login.php' || $self == 'reset.php') {
			
		}else{
			redirect($config['admin_url'].'login.php');
		}
	}
	// End Login Bufer
}
// end login buffer :)