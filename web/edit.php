<?php 
header('Content-type: text/html;charset=utf-8'); 
require_once('permission_filter.php');
require_once('dao/messageDao.php');

$status = true;
$errorMsg = '';
// param validate
if (!isset($_GET['message_id'])) {
  $errorMsg = 'Lack parameter.';
  $status = false;
} else {
  $messageId = $_GET['message_id'];

  $messageDao = new MessageDao();
  $result = $messageDao->getById($messageId);

  if ($result) {
    $status = true;
  } else {
    $errorMsg = 'Invalid parameter.';
    $status = false;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="Content-Type" content="text/html; charset=utf-8">
    <title>Message Edit</title>
    <link rel="stylesheet" type="text/css" href="libs/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <script type="text/javascript" src="libs/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/edit.js"></script>
  </head>
  <body>
    <header class="header">
        <?php include_once('header.php'); ?>
    </header>
    <div class="page">
      <div class="content">
        <?php if ($status) {
        ?>
        <form id="messageEditForm">
          <input type="hidden" name="message-id" value="<?php echo $messageId; ?>">
          <div class="form-group">
            <label>Title: </label>
            <input type="text" name="message-title" id="messageTitle" value="<?php echo htmlspecialchars($result['title']); ?>">
            <span class="tips title-tips"></span>
          </div>
          <div class="form-group">
            <label>Content: </label>
            <textarea name="message-content" id="messageContent"><?php echo htmlspecialchars($result['content']); ?></textarea>
            <span class="tips content-tips"></span>
          </div>
          <div class="form-group">
            <label></label>
            <input type="button" id="editBtn" value="Edit">
          </div>
        </form>
        <?php
        } else {
        ?>
        <div class="error"><?php echo $errorMsg; ?></div>
        <?php
        }
        ?>
      </div>
      <footer class="footer">
        <?php include_once('footer.php'); ?>
      </footer>
    </div>
  </body>
</html>