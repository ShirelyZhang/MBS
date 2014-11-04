<?php
header('Content-type: text/html;charset=utf-8');
require_once('DB.php');
require_once('const.php');

function escapeKeyword($keyword) {
	$keyword = trim($keyword);
	$search = array('\\', '%', '_');
    $replace = array('\\\\', '\\%', '\\_');
	$keyword = str_replace($search, $replace, $keyword);
	return $keyword;
}

// get params
$messageTitle = isset($_GET['message-title']) ? trim($_GET['message-title']) : '';
$messageContent = isset($_GET['message-content']) ? trim($_GET['message-content']) : '';
$messageAuthor = isset($_GET['message-author']) ? trim($_GET['message-author']) : '';
$pageSize = (isset($_GET['page_size']) && $_GET['page_size']) ? (int)$_GET['page_size'] : PAGE_SIZE;
$currentPage = (isset($_GET['current_page']) && $_GET['current_page']) ? (int)$_GET['current_page'] : CURRENT_PAGE;

// connect mysql
$conn = DB::getConn();

$conn->exec('set names utf8');

$messageTitle = '%' . escapeKeyword($messageTitle) . '%';
$messageContent = '%' . escapeKeyword($messageContent) . '%';
$messageAuthor = '%' . escapeKeyword($messageAuthor) . '%';
$startPos = ($currentPage - 1) * $pageSize;

// get count
$sql = 'select COUNT(*) from message join user on message.user_id = user.user_id where message.title like ? and 
        message.content like ? and user.nickname like ? order by message.created desc';
$stmt = $conn->prepare($sql);
$stmt->execute(array($messageTitle, $messageContent, $messageAuthor));
$count = $stmt->fetchColumn();

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

foreach ($messages as $key => $message) {
    $messages[$key]['title'] = htmlspecialchars($message['title']);
    $messages[$key]['nickname'] = htmlspecialchars($message['nickname']);
}

$result = array(
    'messages' => $messages,
    'count' => $count
);

echo json_encode($result);