<?php
header('Content-type: text/html;charset=utf-8');
require_once('dao/messageDao.php');

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

$messageDao = new MessageDao();
$message = $messageDao->getById($messageId);

if (!$message) {
	echo 'This message is already deleted.';
	return ;
}

$result = $messageDao->delete($messageId);

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}




