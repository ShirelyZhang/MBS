<?php
require_once('dao/userDao.php');

$nickname = $_GET['nickname'];

$userDao = new UserDao();
$result = $userDao->getByNickname($nickname);

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}

