<?php
include 'conn.php';
include "inc/security.php";
$session_id = session_id();
if (!isset($_REQUEST['id'])) {
	redirect($config['url']);
}else{
	$session_id = session_id();
	$id = mysql_real_escape_string($_REQUEST['id']);
	$quantaty = mysql_real_escape_string($_REQUEST['up']);

	$query=mysql_query("UPDATE `inquiry_cart` SET `quantity`='$quantaty' WHERE prdid='$id' AND session_id = '$session_id'") or die(mysql_error());
	if($query == true){
	@header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
	}
}
?>