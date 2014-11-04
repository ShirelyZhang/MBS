<?php
require_once('db_config.php');

/* if (!isset($_GET['nickname'])) {
	echo 'invalid param';
	return;
} */

$nickname = $_GET['nickname'];

// connect mysql
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

try {
	$conn = new PDO($dsn, DB_USER, DB_PWD);
} catch (PDOException $error) {
	die('Connect DB failed: ' . $error->getMessage());
}

$conn->query('set names utf8');

$sql = 'select user_id from user where nickname = ?';
$statement = $conn->prepare($sql);
$statement->execute(array($nickname));

$result = $statement->fetchAll();

if ($result) {
	echo 'success';
} else {
	echo 'fail';
}

