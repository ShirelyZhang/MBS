<?php
require_once('DB.php');
require_once('const.php');
require_once('model/User.php');

class UserDao
{
	public function getByNickname($nickname)
	{
		$conn = DB::getConn();
		$conn->exec('set names utf8');

		$sql = 'select user_id from user where nickname = ?';
		$statement = $conn->prepare($sql);
		$statement->execute(array($nickname));

		$result = $statement->fetch();
		return $result;
	}

	public function getByNicknameAndPwd($nickname, $password)
	{
		$password = md5($password);

		$conn = DB::getConn();
		$conn->exec('set names utf8');
		$sql = 'select user_id from user where nickname = ? and password = ?';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array($nickname, $password));

		$result = $stmt->fetchAll();
		return $result;
	}

	public function getByNicknameAndMessageId($nickname, $messageId)
	{
		$conn = DB::getConn();
		$conn->exec('set names utf8');
		$sql = 'select * from user join message on user.user_id = message.user_id where user.nickname = ? and message.message_id = ?';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array($nickname, $messageId));
		$result = $stmt->fetch();

		return $result;
	}

	public function insert(User $user)
	{
		$params = array(
			$user->getNickname(),
			$user->getPassword(),
			$user->getCreated(),
			$user->getUpdated()
		);

		$conn = DB::getConn();
		$conn->exec('set names utf8');

		$sql = 'insert into user(nickname, password, created, updated) values(?, ?, ?, ?)';
		$statement = $conn->prepare($sql);
		$statement->execute($params);
		$userId = $conn->lastInsertId();

		return $userId;
	}
}