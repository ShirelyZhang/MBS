<?php
header('Content-type: text/html;charset=utf-8');
require_once('dao/userDao.php');

session_start();

// validate params
if (!isset($_POST['nickname'])) {
	echo 'nickname can not be empty.';
	return ;
} else if (!isset($_POST['pwd'])) {
	echo 'password can not be empty.';
	return ;
}

// validate nickname and password
$nickname = $_POST['nickname'];
$password = $_POST['pwd'];

$userDao = new UserDao();
$result = $userDao->getByNicknameAndPwd($nickname, $password);

if ($result) {
	// update session
	$_SESSION['nickname'] = $nickname;

	echo 'success';
} else {
	echo 'fail';
}
