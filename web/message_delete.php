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
if (!isset($_POST['message_id'])) {
	echo 'Lack parameter.';
	return ;
}

$messageId = $_POST['message_id'];

// connect database
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
try {
	$conn = new PDO($dsn, DB_USER, DB_PWD);
} catch (PDOException $error) {
	die('Connect failed: ' . $error->getMessage());
}

$conn->exec('set names utf8');

$sql = 'select * from message where message_id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute(array($messageId));
$message = $stmt->fetch();

if (!$message) {
	echo 'This message is already deleted.';
	return ;
}

$sql = 'delete from message where message_id = ?';
$stmt = $conn->prepare($sql);
$result = $stmt->execute(array($messageId));

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}




