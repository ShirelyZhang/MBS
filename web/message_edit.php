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
if (!isset($_POST['message-id']) 
	|| !isset($_POST['message-title']) 
		|| !isset($_POST['message-content'])) {

	echo 'Lack parameter.';
	return ;
} else if (!trim($_POST['message-title'])) {
	echo 'Message title can not be empty.';
	return ;
} else if (!trim($_POST['message-content'])) {
	echo 'Message content can not be empty.';
	return ;
}

$messageId = $_POST['message-id'];
$messageTitle = trim($_POST['message-title']);
$messageContent = trim($_POST['message-content']);

// connect database
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
try {
	$conn = new PDO($dsn, DB_USER, DB_PWD);
} catch (PDOException $error) {
	die('Connect failed: ' . $error->getMessage());
}

$conn->exec('set names utf8');

// validate the message's author is current user
$sql = 'select * from user join message on user.user_id = message.user_id where user.nickname = ? and message.message_id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute(array($_SESSION['nickname'], $messageId));
$result = $stmt->fetch();

if (!$result) {
	echo 'This message is not pubished by current user.';
	return ;
}

$sql = 'update message set title = ? , content = ? , updated = NOW() where message_id = ?';
$stmt = $conn->prepare($sql);
$result = $stmt->execute(array($messageTitle, $messageContent, $messageId));

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}




