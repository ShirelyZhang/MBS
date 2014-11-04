<?php
require_once('const.php');
session_start();

$noNeedFilterUrls = array(
	'/index.php', 
	'/detail.php', 
	'/register.php', 
	'/login.php',
	'/logout.php'
);
$needFilterUrls = array(
	'/my-messages.php', 
	'/create.php', 
	'/edit.php', 
	'/message_create.php',
	'/message_edit.php', 
	'/message_delete.php'
);

$currentUrl = $_SERVER['PHP_SELF'];
$loginUrl = '/login.php';

if (in_array($currentUrl, $noNeedFilterUrls)) {
	if (($currentUrl == $loginUrl) && isset($_SESSION['nickname'])) {
		header('Location:index.php');
	} else {
		// do nothing
	}
} else if (in_array($currentUrl, $needFilterUrls)) {
	
	if (isset($_SESSION['nickname'])) {
		// do nothing
	} else {
		header('Location:login.php');
	}
}
