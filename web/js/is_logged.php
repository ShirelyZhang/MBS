<?php
require_once('const.php');
if (isset($_SESSION['nickname']) && strlen($_SESSION['nickname']) > 0) {
	// return true;
} else {
	header(BASE_URL . 'login.php');
}