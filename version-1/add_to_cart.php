<?php
include 'conn.php';
echo $prdid;
$session_id = session_id();
if (!isset($_GET['prd_id'])) {
	redirect($config['url']);
}else{
$prdid = mysql_real_escape_string($_GET['prd_id']);
if(!isset($_POST['quent'])){ $quantity = 1; }else{ $quantity = mysql_real_escape_string($_POST['quent']); }
$check_inq = mysql_query("select * from inquiry_cart where prdid='$prdid' AND session_id = '$session_id'");
	if(mysql_num_rows($check_inq)>0){
		mysql_query("UPDATE inquiry_cart SET quantity=quantity+$quantity WHERE prdid='$prdid' AND session_id = '$session_id'");
	}else{
		mysql_query("INSERT INTO inquiry_cart(session_id, prdid, quantity) VALUES('$session_id', '$prdid', '$quantity')") or die(mysql_error());
	}
	redirect($config['url'].'cart/'); 
}
?>
