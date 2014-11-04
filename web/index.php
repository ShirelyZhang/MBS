<?php 
header('Content-type: text/html;charset=utf-8'); 
require_once('permission_filter.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="Content-Type" content="text/html; charset=utf-8">
    <title>Message Board</title>
    <link rel="stylesheet" type="text/css" href="libs/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="libs/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
  </head>
  <body>
    <header class="header">
        <?php include_once('header.php'); ?>
      </header>
    <div class="page">
      <div class="content">
        <div class="filter-section">
          <form id="messageSearchForm">
            <input type="text" name="message-title" placeholder="Title">
            <input type="text" name="message-content" placeholder="Content">
            <input type="text" name="message-author" placeholder="Author">
            <input type="button" value="Search" id="searchBtn">
            <span></span>
            <!--<a href="create.php" id="createLink">Create Message</a>-->
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
              </thead>
              <tbody id="messageListTbody">
                <tr><td colspan="4">No Record</td></tr>
              </tbody>
            </table>
          </div>
          <div class="pagination-layer"><?php include 'pagination.php'; ?></div>
        </div>
      </div>
      <footer class="footer">
        <?php include_once('footer.php'); ?>
      </footer>
    </div>
  </body>
</html>