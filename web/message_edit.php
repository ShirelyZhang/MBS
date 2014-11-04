<?php
header('Content-type: text/html;charset=utf-8');
require_once('dao/userDao.php');
require_once('dao/messageDao.php');

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
$now = date('Y-m-d H:i:s');

$userDao = new UserDao();
$result = $userDao->getByNicknameAndMessageId($_SESSION['nickname'], $messageId);
if (!$result) {
	echo 'This message is not pubished by current user.';
	return ;
}

$message = new Message();
$message->setMessageId($messageId);
$message->setTitle($messageTitle);
$message->setContent($messageContent);
$message->setUpdated($now);

$messageDao = new MessageDao();
$result = $messageDao->update($message);

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}




