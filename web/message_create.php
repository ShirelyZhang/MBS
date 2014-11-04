<?php
header('Content-type: text/html;charset=utf-8');
require_once('dao/userDao.php');
require_once('dao/messageDao.php');
require_once('model/Message.php');

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

$userDao = new UserDao();
$result = $userDao->getByNickname($nickname);
$userId = $result['user_id'];

$message = new Message();
$message->setUserId($userId);
$message->setTitle($messageTitle);
$message->setContent($messageContent);
$message->setCreated($now);
$message->setUpdated($now);

$messageDao = new messageDao();
$result = $messageDao->insert($message);

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}




