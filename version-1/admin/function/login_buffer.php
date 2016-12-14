<?php
if (!isset($_SESSION['user']) OR $_SESSION['login'] !== "login") {
	redirect($config['admin_url'].'login.php');
}
?>