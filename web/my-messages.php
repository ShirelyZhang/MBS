<?php 
header('Content-type: text/html;charset=utf-8'); 
require_once('permission_filter.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="Content-Type" content="text/html; charset=utf-8">
    <title>Message Board</title>
    <link rel="stylesheet" type="text/css" href="libs/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/my-messages.css">
    <script type="text/javascript" src="libs/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="libs/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/my-messages.js"></script>
  </head>
  <body>
    <div class="container">
      <header class="row">
          <?php include_once('header.php'); ?>
        </header>
      <div class="row page">
        <div class="content">
          <div class="filter-section">
            <form id="messageSearchForm">
              <input type="hidden" name="message-author" value="<?php echo $_SESSION['nickname'];?>">
              <input type="text" name="message-title" placeholder="Title">
              <input type="text" name="message-content" placeholder="Content">
              <input type="button" value="Search" id="searchBtn">
              <a href="create.php" id="createLink">Create Message</a>
            </form>
          </div>
          <div class="message-list-block">
            <div class="pagination-layer"><?php include 'pagination.php'; ?></div>
            <div class="message-list-table">
              <table id="messageListTable">
                <thead>
                  <th class="col-id">ID</th>
                  <th class="col-title">Title</th>
                  <th class="col-author">Author</th>
                  <th class="col-created">Created</th>
                  <th class="col-operation">Operation</th>
                </thead>
                <tbody id="messageListTbody">
                  <tr><td colspan="5">No Record</td></tr>
                </tbody>
              </table>
            </div>
            <div class="pagination-layer"><?php include 'pagination.php'; ?></div>
          </div>
        </div>
        <footer class="row">
          <?php include_once('footer.php'); ?>
        </footer>
      </div>
    </div>
  </body>
</html>