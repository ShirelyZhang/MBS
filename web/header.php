<div class="header-block">
  <h2 class="logo-title"><a href="index.php" title="Message Board">Message Board</a></h2>
  <div class="nav-bar">
    <a href="index.php" class="nav-link" data-type="0">All Messages</a>
    <a href="my-messages.php" class="nav-link" data-type="1">My Messages</a>
    <!--<a href="my-profile.php" class="nav-link" data-type="2">My Profile</a>-->
  </div>
  <?php
  	session_start();
  	if (isset($_SESSION['nickname'])) {
  ?>
	<div class="welcome-block">
		<span class="welcome-info"><?php echo htmlspecialchars($_SESSION['nickname']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
  <?php
  	} else {
  ?>
  	<div class="log-btns">
	    <a href="login.php">Login</a>
	    <span>|</span>
	    <a href="register.php">Register</a>
  </div>
  <?php
  	}
  ?>
</div>
<!--<script type="text/javascript" src="js/header.js"></script>-->