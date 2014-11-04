<?php 
header('Content-type: text/html;charset=utf-8'); 
require_once('permission_filter.php');
require_once('db_config.php');

$status = true;
// param validate
if (!isset($_GET['message_id'])) {
  $status = false;
} else {
  $messageId = $_GET['message_id'];

  // connect database
  $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
  try {
    $conn = new PDO($dsn, DB_USER, DB_PWD);
  } catch (PDOException $error) {
    die('connect failed: ' . $error->getMessage());
  }

  $conn->exec('set names utf8');

  $sql = 'select m.message_id, m.title, m.content, m.created, m.updated, user.nickname from message m join user on m.user_id = user.user_id where m.message_id = ?';
  $stmt = $conn->prepare($sql);
  $stmt->execute(array($messageId));
  $result = $stmt->fetch();

  if ($result) {
    $status = true;
  } else {
    $status = false;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="Content-Type" content="text/html; charset=utf-8">
    <title>Message Detail</title>
    <link rel="stylesheet" type="text/css" href="libs/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <script type="text/javascript" src="libs/jquery/jquery-1.9.1.min.js"></script>
  </head>
  <body>
    <header class="header">
        <?php include_once('header.php'); ?>
    </header>
    <div class="page">
      <div class="content">
        <!--<h1 class="title">Message Detail</h1>-->
        <?php if ($status) {
        ?>
        <div class="detail-block">
          <div class="form-group">
            <span>Title: </span>
            <p><?php echo htmlspecialchars($result['title']); ?></p>
          </div>
          <div class="form-group">
            <span>Content: </span>
            <p><?php echo htmlspecialchars($result['content']); ?></p>
          </div>
          <div class="form-group">
            <span>Author: </span>
            <p><?php echo htmlspecialchars($result['nickname']); ?></p>
          </div>
          <div class="form-group">
            <span>Created: </span>
            <p><?php echo $result['created']; ?></p>
          </div>
          <div class="form-group">
            <span>Last Updated: </span>
            <p><?php echo $result['updated']; ?></p>
          </div>
        </div>
        <?php
        } else {
        ?>
        <div>Invalid param.</div>
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