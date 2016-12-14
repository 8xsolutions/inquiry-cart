<?php
error_reporting(0);
include "admin/function/config.ini.php";
include "admin/function/function.ini.php";
include "admin/plugins/phpmailer/PHPMailerAutoload.php";
include "admin/plugins/geoplugin.class/geoplugin.class.php";
include "admin/function/site_setting.ini.php";
##############################################################################
# Now First Adin User Detail
##############################################################################
$uq = mysql_query("SELECT * FROM `admin` WHERE `id` = 1");
$u = mysql_fetch_object($uq);
##############################################################################
# setting
##############################################################################
$get_data = mysql_query("SELECT * FROM setting WHERE id = 1");
$data = mysql_fetch_object($get_data);
##############################################################################
# Seo
##############################################################################
$seo_data = mysql_query("SELECT * FROM seo WHERE id = 1");
$s = mysql_fetch_object($seo_data);
##############################################################################
# Get Banner
##############################################################################
$banner_data = mysql_query("SELECT * FROM `banner` ORDER BY rand() LIMIT 1 ");
$b = mysql_fetch_object($banner_data);
//Anti SQLi (SQL Injection)
foreach ($array as $d) {
    $string = security($_SERVER['QUERY_STRING']);
    if (strpos(strtolower($string), $d) !== false) {
        $ip         = $_SERVER['REMOTE_ADDR'];
        $loc        = $_SERVER['PHP_SELF'];
        $browseros  = $_SERVER['HTTP_USER_AGENT'];
        $oslanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $date       = date("d.m.Y / H:i:s");
        $file       = security('' . $loc . '?' . $string . '');
        $type       = "SQL Injection";
        $queryvalid = mysql_query("SELECT * FROM `hacker-attacks` WHERE file='$file' and type='SQL Injection' LIMIT 1");
        @$validator = mysql_num_rows($queryvalid);
        if ($validator > "0") {
            echo '<meta http-equiv="refresh" content="0;url='.$config['url'].'block/blocked.php" />';
            exit();
        } else {
            $log    = "INSERT INTO `hacker-attacks` (ip, date, file, type, browseros, oslanguage) VALUES ('$ip', '$date', '$file', '$type', '$browseros', '$oslanguage')";
            $result = mysql_query($log);
            mysql_query("INSERT INTO `bans`(`id`, `ip`, `date`, `reason`) VALUES (NULL,'{$ip}','{$date}','Sql Attack')");
            echo '<meta http-equiv="refresh" content="0;url='.$config['url'].'block/blocked.php" />';
            exit();
        }
    }
}
//Ban System
$self = end(explode('/', $_SERVER['PHP_SELF']));
$guestip     = $_SERVER['REMOTE_ADDR'];
$querybanned = mysql_query("SELECT * FROM `bans` WHERE ip='$guestip'");
$banned      = mysql_num_rows($querybanned);
$row         = mysql_fetch_array($querybanned);
if ($banned > "0") {
	if ( $self == 'blocked.php' || $self == 'banned.php') {
				
	}else{
		// echo '<meta http-equiv="refresh" content="0;url='.$config['url'].'block/banned.php" />';
	}
    
}
?>