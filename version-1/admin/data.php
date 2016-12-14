<?php
	include('function/config.ini.php');
	include('function/function.ini.php');
	include('function/setting.ini.php');
	include('plugins/geoplugin.class/geoplugin.class.php');
	include('plugins/phpmailer/PHPMailerAutoload.php');
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
?>