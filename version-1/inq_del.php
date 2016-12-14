<?php
include 'conn.php';
$session_id = session_id();
if (!isset($_GET['id'])) {
	redirect($config['url']);
}else{
	$session_id = session_id();
	$id = mysql_real_escape_string($_GET['id']);
	$query=mysql_query("DELETE from inquiry_cart where id='$id' AND session_id = '$session_id'") or die(mysql_error());
	redirect($_SERVER['HTTP_REFERER']);
}
?>