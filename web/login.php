<?php 
header('Content-type: text/html;charset=utf-8'); 
require_once('permission_filter.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="Content-Type" content="text/html; charset=utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="libs/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script type="text/javascript" src="libs/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
  </head>
  <body>
    <header class="header">
        <?php include_once('header.php'); ?>
    </header>
    <div class="page">
      <div class="content">
        <h1 class="title">User Login</h1>
        <form action="" class="login-form" id="logForm">
          <table class="logTable">
            <tr class="form-group">
              <td><span class="errors"></span></td>
            </tr>
            <tr class="form-group">
              <td><input type="text" name="nickname" id="nickname" placeholder="Nickname"></td>
            </tr>
            <tr class="form-group">
              <td><input type="password" name="pwd" id="pwd" placeholder="Password"></td>
            </tr>
            <tr class="form-group">
              <td><input type="button" id="logBtn" value="Login"></td>
            </tr>
          </table>
        </form>
      </div>
      <footer class="footer">
        <?php include_once('footer.php'); ?>
      </footer>
    </div>
  </body>
</html>