<?php 
header('Content-type: text/html;charset=utf-8'); 
require_once('permission_filter.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="Content-Type" content="text/html; charset=utf-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="libs/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <script type="text/javascript" src="libs/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
  </head>
  <body>
    <header class="header">
        <?php include_once('header.php'); ?>
    </header>
    <div class="page">
      <div class="content">
        <h1 class="title">User Register</h1>
        <form action="" class="register-form" id="regForm">
          <table>
            <tr class="form-group">
              <th><label class="control-label">Nickname</label></th>
              <td><input type="text" name="nickname" id="nickname"></td>
              <td><span class="nickname-tips tips">Consist of chinese character, letter, number, underscore, 1-255 characters.</span></td>
            </tr>
            <tr class="form-group">
              <th><label>Password</label></th>
              <td><input type="password" name="pwd" id="pwd"></td>
              <td><span class="pwd-tips tips">Consist of letter, number, underscore, 6-20 characters.</span></td>
            </tr>
            <tr class="form-group">
              <th><label>Confirm Password</label></th>
              <td><input type="password" name="confirmPwd" id="confirmPwd"></td>
              <td><span class="confirm-pwd-tips tips"></span></td>
            </tr>
            <tr class="form-group">
              <td></td>
              <td><input type="button" id="regBtn" value="Register"></td>
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