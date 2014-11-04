<?php
header('Content-type: text/html;charset=utf-8');
require_once('model/User.php');
require_once('dao/userDao.php');

// validate params
$nicknameFormat = '/^[\x{4e00}-\x{9fa5}\w]+$/u';
$pwdFormat = '/^\w+$/';

if (!isset($_POST['nickname'])) {
	echo 'nickname can not be empty.';
	return ;
} else if (!isset($_POST['pwd'])) {
	echo 'password can not be empty.';
	return ;
} else if (!isset($_POST['confirmPwd'])) {
	echo 'confirm password can not be empty.';
	return ;
} else if (!preg_match($nicknameFormat, $_POST['nickname']) || strlen($_POST['nickname']) > 255) {
	echo 'please input valid nickname.';
	return ;
} else if (!preg_match($pwdFormat, $_POST['pwd']) || strlen($_POST['pwd']) < 6 || strlen($_POST['pwd']) > 20) {
	echo 'please input valid password.';
	return ;
} else if ($_POST['pwd'] != $_POST['confirmPwd']) {
	echo 'The two password is not same.';
	return ;
}

$nickname = $_POST['nickname'];
$password = $_POST['pwd'];

$userDao = new UserDao();

$result = $userDao->getByNickname($nickname);

// nickname is exist
if ($result) {
	echo 'nickname is exist.';
	return ;
}

$now = date('Y-m-d H:i:s');
$user = new User();
$user->setNickname($nickname);

$user->setPassword($password);
$user->setCreated($now);
$user->setUpdated($now);

$userId = $userDao->insert($user);

if ($userId) {
	echo 'success';
} else {
	echo 'fail';
}



