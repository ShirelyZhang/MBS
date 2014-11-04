<?php
header('Content-type: text/html;charset=utf-8');
require_once('db_config.php');

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
$password = md5($_POST['pwd']);
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

try {
	$conn = new PDO($dsn, DB_USER, DB_PWD);
} catch (PDOException $error) {
	die('Connect DB failed: ' . $error->getMessage());
}
// set encode utf-8
$conn->exec('set names utf8');

$sql = 'select user_id from user where nickname = ?';
$statement = $conn->prepare($sql);
$statement->execute(array($nickname));

$result = $statement->fetchAll();

// nickname is exist
if ($result) {
	echo 'nickname is exist.';
	return ;
}

$now = date('Y-m-d H:i:s');

$sql = 'insert into user(nickname, password, created, updated) values(?, ?, ?, ?)';
$statement = $conn->prepare($sql);
$statement->execute(array($nickname, $password, $now, $now));
$user_id = $conn->lastInsertId();
// $result = $statement->fetch();

if ($user_id) {
	echo 'success';
} else {
	echo 'fail';
}



