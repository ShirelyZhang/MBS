<?php
header('Content-type: text/html;charset=utf-8');
require_once('db_config.php');

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
$password = md5($_POST['pwd']);

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
try{
	$conn = new PDO($dsn, DB_USER, DB_PWD);
} catch (PDOException $error) {
	die('Connect failed: ' . $e->getMessage());
}

// set encode
$conn->exec('set names utf8');

// sql statement
$sql = 'select user_id from user where nickname = ? and password = ?';
$stmt = $conn->prepare($sql);
$stmt->execute(array($nickname, $password));

$result = $stmt->fetchAll();

if ($result) {
	// update session
	$_SESSION['nickname'] = $nickname;

	echo 'success';
} else {
	echo 'fail';
}
