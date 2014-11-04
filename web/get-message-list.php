<?php
header('Content-type: text/html;charset=utf-8');
require_once('const.php');
require_once('dao/messageDao.php');

// get params
$messageTitle = isset($_GET['message-title']) ? trim($_GET['message-title']) : '';
$messageContent = isset($_GET['message-content']) ? trim($_GET['message-content']) : '';
$messageAuthor = isset($_GET['message-author']) ? trim($_GET['message-author']) : '';
$pageSize = (isset($_GET['page_size']) && $_GET['page_size']) ? (int)$_GET['page_size'] : PAGE_SIZE;
$currentPage = (isset($_GET['current_page']) && $_GET['current_page']) ? (int)$_GET['current_page'] : CURRENT_PAGE;

$query = array(
	'title' => $messageTitle,
	'content' => $messageContent,
	'author' => $messageAuthor,
	'page_size' => $pageSize,
	'current_page' => $currentPage
);

$messageDao = new MessageDao();

$count = $messageDao->getCountByQuery($query);
$messages = $messageDao->getByQuery($query);

foreach ($messages as $key => $message) {
    $messages[$key]['title'] = htmlspecialchars($message['title']);
    $messages[$key]['nickname'] = htmlspecialchars($message['nickname']);
}

$result = array(
    'messages' => $messages,
    'count' => $count
);

echo json_encode($result);