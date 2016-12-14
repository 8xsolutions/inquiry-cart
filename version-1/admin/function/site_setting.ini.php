<?php
session_start();
// Now Connect Function
$connect = connect($config['db_host'],$config['db_user'],$config['db_pass'],$config['db']);
if ($connect != true) {
	die("Database Not Found");
}
// Geating Ip address
// $ip = getRealIpAddr();
// $geoplugin->locate('$ip');
// $check_record = mysql_result(mysql_query("SELECT count('id') FROM `ban-country` WHERE `country` = '{$geoplugin->countryName}' "), 0);
// if ($check_record > 0) {
// 	if(isset($_SESSION['ACCESS_LOCK'])){
		
// 	}else{
// 		redirect('lock.php');
// 	}
// }

// End Connect Function
define('theme_root', $config['url'].'theme/');
define('css', theme_root.'css/');
define('js', theme_root.'js/');
define('img', theme_root.'images/');
define('upload', theme_root.'upload/');
//Anti XSS (Cross-site Scripting)
function security($input)
{
    $input = mysql_real_escape_string($input);
    $input = strip_tags($input);
    $input = stripslashes($input);
    return $input;
}