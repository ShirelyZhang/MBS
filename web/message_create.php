<?php
header('Content-type: text/html;charset=utf-8');
require_once('db_config.php');

// permission validate
session_start();
if (!isset($_SESSION['nickname'])) {
	echo 'permission denied';
	return ;
}

// param validate
if (!isset($_POST['message-title']) || !isset($_POST['message-content'])) {
	echo 'Lack parameter.';
	return ;
} else if (!trim($_POST['message-title'])) {
	echo 'Message title can not be empty.';
	return ;
} else if (!trim($_POST['message-content'])) {
	echo 'Message content can not be empty.';
	return ;
}

$nickname = $_SESSION['nickname'];
$messageTitle = trim($_POST['message-title']);
$messageContent = trim($_POST['message-content']);
$now = date('Y-m-d H:i:s');

// connect database
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
try {
	$conn = new PDO($dsn, DB_USER, DB_PWD);
} catch (PDOException $error) {
	die('Connect failed: ' . $error->getMessage());
}

$conn->exec('set names utf8');

// search user id according to nickname
$sql = 'select user_id from user where nickname = ?';
$stmt = $conn->prepare($sql);
$stmt->execute(array($nickname));
$result = $stmt->fetch();
$userId = $result['user_id'];

$sql = 'insert into message(user_id, title, content, created, updated) values(?, ?, ?, ?, ?)';
$stmt = $conn->prepare($sql);
$result = $stmt->execute(array($userId, $messageTitle, $messageContent, $now, $now));

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}




