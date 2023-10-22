<html>
<?php
session_name('YourloginID');
session_start();//start the session_cache_expire
//if there is no session present, the user is redirected 
if(!isset($_SESSION['firstname'])) {
header("location: http://" .$_SERVER['HTTP_HOST'].dirname($_SERVER['$PHP_SELF'])."/onpoint/index.php");
exit();//quit the script
}
//set the page title and include the main html header from the project's includes directory
$pagetitle = "{$_SESSION['firstname']}";
include("./includes/header.php");


?>
<body>
<div id="content">
<?php echo "<p>Logged in as {$_SESSION['firstname']}</p>";?>
<p>Click on the links below to view upcoming movies or to buy a ticket</p>
	<fieldset>
	<legend>User Actions</legend>
     <a href="viewmovies.php"><p>Browse available movies</p></a>
	 <a href="resetpassword.php"><p>Change your password</p></a>
	 <a href="buyticket.php"><p>Pay for a ticket</p></a>
	 <a href="logout.php"><p>Log out</p></a>	
	</fieldset>
</div>
</body>
</html>