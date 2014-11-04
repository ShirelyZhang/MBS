<?php 
header('Content-type: text/html;charset=utf-8'); 
require_once('permission_filter.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="Content-Type" content="text/html; charset=utf-8">
    <title>Message Create</title>
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
        <form id="messageEditForm">
          <div class="form-group">
            <label>Title: </label>
            <input type="text" name="message-title" id="messageTitle">
            <span class="tips title-tips"></span>
          </div>
          <div class="form-group">
            <label>Content: </label>
            <textarea name="message-content" id="messageContent"></textarea>
            <span class="tips content-tips"></span>
          </div>
          <div class="form-group">
            <label></label>
            <input type="button" id="createBtn" value="Create">
          </div>
        </form>
      </div>
      <footer class="footer">
        <?php include_once('footer.php'); ?>
      </footer>
    </div>
  </body>
</html>