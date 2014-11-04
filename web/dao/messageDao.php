<?php
require_once('DB.php');
require_once('const.php');
require_once('model/Message.php');

class MessageDao
{

	public function getCountByQuery(array $query)
	{
		$messageTitle = isset($query['title']) ? $query['title'] : '';
		$messageContent = isset($query['content']) ? $query['content'] : '';
		$messageAuthor = isset($query['author']) ? $query['author'] : '';

		$messageTitle = '%' . $this->escapeKeyword($messageTitle) . '%';
		$messageContent = '%' . $this->escapeKeyword($messageContent) . '%';
		$messageAuthor = '%' . $this->escapeKeyword($messageAuthor) . '%';

		// connect mysql
		$conn = DB::getConn();

		$conn->exec('set names utf8');

		// get count
		$sql = 'select COUNT(*) from message join user on message.user_id = user.user_id where message.title like ? and 
		        message.content like ? and user.nickname like ? order by message.created desc';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array($messageTitle, $messageContent, $messageAuthor));
		$count = $stmt->fetchColumn();

		return $count;
	}

	public function getByQuery(array $query)
	{
		// $messageId = isset($query['message_id']) ? $query['message_id'] : '';
		$messageTitle = isset($query['title']) ? $query['title'] : '';
		$messageContent = isset($query['content']) ? $query['content'] : '';
		$messageAuthor = isset($query['author']) ? $query['author'] : '';
		$pageSize = isset($query['page_size']) ? $query['page_size'] : PAGE_SIZE;
		$currentPage = isset($query['current_page']) ? $query['current_page'] : CURRENT_PAGE;
		$startPos = ($currentPage - 1) * $pageSize;

		$messageTitle = '%' . $this->escapeKeyword($messageTitle) . '%';
		$messageContent = '%' . $this->escapeKeyword($messageContent) . '%';
		$messageAuthor = '%' . $this->escapeKeyword($messageAuthor) . '%';

		// connect mysql
		$conn = DB::getConn();

		$conn->exec('set names utf8');

		$sql = 'select message.message_id, message.title, user.nickname, message.created from message 
				join user on message.user_id = user.user_id where message.title like ? and 
				message.content like ? and user.nickname like ? order by message.created desc limit ?, ?';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $messageTitle, PDO::PARAM_STR);
		$stmt->bindParam(2, $messageContent, PDO::PARAM_STR);
		$stmt->bindParam(3, $messageAuthor, PDO::PARAM_STR);
		$stmt->bindParam(4, $startPos, PDO::PARAM_INT);
		$stmt->bindParam(5, $pageSize, PDO::PARAM_INT);
		$stmt->execute();

		$messages = $stmt->fetchAll();
		return $messages;
	}

	public function getById($messageId)
	{
		$conn = DB::getConn();
		$conn->exec('set names utf8');
		$sql = 'select m.message_id, m.title, m.content, m.created, m.updated, user.nickname from message
				 m join user on m.user_id = user.user_id where m.message_id = ?';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array($messageId));
		$message = $stmt->fetch();
		return $message;
	}

	public function insert(Message $message)
	{
		$params = array(
			$message->getUserId(),
			$message->getTitle(),
			$message->getContent(),
			$message->getCreated(),
			$message->getUpdated()
		);

		$conn = DB::getConn();
		$conn->exec('set names utf8');

		$sql = 'insert into message(user_id, title, content, created, updated) values(?, ?, ?, ?, ?)';
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute($params);
		return $result;
	}

	public function update(Message $message)
	{
		$params = array(
			$message->getTitle(),
			$message->getContent(),
			$message->getUpdated(),
			$message->getMessageId()
		);

		$conn = DB::getConn();
		$conn->exec('set names utf8');

		$sql = 'update message set title = ? , content = ? , updated = ? where message_id = ?';
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute($params);
		return $result;
	}

	public function delete($messageId)
	{
		$conn = DB::getConn();
		$conn->exec('set names utf8');
		$sql = 'delete from message where message_id = ?';
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute(array($messageId));
		return $result;
	}

	private function escapeKeyword($keyword)
	{
		$keyword = trim($keyword);
		$search = array('\\', '%', '_');
	    $replace = array('\\\\', '\\%', '\\_');
		$keyword = str_replace($search, $replace, $keyword);
		return $keyword;
	}
}